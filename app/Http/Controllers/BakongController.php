<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Store;
use App\Models\UserPayment;
use App\Models\PaymentStatus;
use App\Models\PaymentAccount;

class BakongController extends Controller
{
    /**
     * Generate a Bakong QR code (API)
     */
    public function generateQr(Request $request)
    {
        $request->validate([
            'order_id'           => 'required|exists:orders,id',
            'currency'           => 'required|in:KHR,USD',
            'payment_account_id' => 'required|exists:payment_accounts,id'
        ]);

        $order = Order::findOrFail($request->order_id);
        $currency = $request->input('currency', 'KHR');
        $paymentAccount = PaymentAccount::findOrFail($request->payment_account_id);

        $displayAmount = ($currency === 'USD') ? round($order->total_amount, 2) : round($order->total_amount * 4100, 0);

        try {
            $khqrString = $this->generateKhqrString(
                $paymentAccount->account_id,
                $paymentAccount->account_name,
                $paymentAccount->account_city ?? 'Phnom Penh',
                $displayAmount,
                $currency,
                'INV-' . $order->id
            );
            $md5 = md5($khqrString);

            // Get stylized QR image from Relay API
            $qrImage = null;
            try {
                $relayUrl = env('API_GENERATE_QR_BAKONG', 'https://api.bakongrelay.com/v1/generate_khqr_image');
                $templateUrl = env('QR_TEMPLATE_URL', 'https://raw.githubusercontent.com/bsthen/bakong-khqr/main/bakong_khqr/template.png');

                $relayResponse = Http::timeout(10)->post($relayUrl, [
                    'qr' => $khqrString,
                    'source' => $templateUrl
                ]);

                if ($relayResponse->successful()) {
                    $rawBody = $relayResponse->body();
                    $isJson = false;

                    if (str_starts_with(trim($rawBody), '{')) {
                        $json = json_decode($rawBody, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $isJson = true;
                            $imageData = $json['data'] ?? $json['qr_image'] ?? $json['image'] ?? null;
                            if (is_array($imageData)) {
                                $imageData = $imageData['image'] ?? $imageData['base64'] ?? $imageData['url'] ?? $imageData['data'] ?? null;
                            }
                            if (is_string($imageData) && !str_starts_with(trim($imageData), '{')) {
                                $qrImage = str_starts_with($imageData, 'data:image') ? $imageData : 'data:image/png;base64,' . $imageData;
                            }
                        }
                    }

                    if (!$isJson && !$qrImage) {
                        $qrImage = 'data:image/png;base64,' . base64_encode($rawBody);
                    }
                }
            } catch (\Exception $e) {
                Log::error('[KHQR] Relay API failed: ' . $e->getMessage());
            }

            $deeplink = $this->generateDeeplink($khqrString); 

            UserPayment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'user_id'            => auth()->id() ?? $order->user_id,
                    'payment_method_id'  => $paymentAccount->id,
                    'payment_status_id'  => 1, // Pending
                    'transaction_id'     => $md5, 
                    'amount'             => $displayAmount,
                    'currency'           => $currency,
                ]
            );

            return response()->json([
                'success' => true,
                'data' => [
                    'qr_string' => $khqrString,
                    'qr_image'  => $qrImage,
                    'deeplink'  => $deeplink,
                    'md5'       => $md5,
                    'amount'    => $displayAmount,
                    'currency'  => $currency,
                    'order_id'  => $order->id
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check Bakong transaction by MD5 (API)
     */
    public function checkMd5(Request $request)
    {
        $request->validate(['md5' => 'required|string']);

        $token = env('BAKONG_API_TOKEN');
        $baseUrl = env('BAKONG_BASE_URL', 'https://api-bakong.nbc.org.kh');

        if (!$token) {
            // Log warning for admin
            Log::warning('[BAKONG] Polling attempted without API Token.');
            
            // For development: If no token, we can check if a special "simulate" flag is passed or just return failed
            return response()->json([
                'success' => false,
                'status'  => 'failed',
                'message' => 'Bakong API Token missing. Please configure your .env file.'
            ]);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type'  => 'application/json'
            ])->timeout(10)->post($baseUrl . '/v1/check_transaction_by_md5', [
                'md5' => $request->md5
            ]);

            $data = $response->json();
            
            // Handle various response formats from Bakong API
            $responseCode = $data['responseCode'] ?? ($data['status']['code'] ?? null);
            $isSuccess = ($responseCode === 0 || $responseCode === '0' || $responseCode === '00');

            if ($isSuccess) {
                $userPayment = UserPayment::where('transaction_id', $request->md5)->first();
                if ($userPayment) {
                    $userPayment->update([
                        'payment_status_id' => 2, // Success
                        'paid_at'           => now(),
                    ]);

                    $order = Order::find($userPayment->order_id);
                    if ($order) {
                        $order->update(['status' => 'paid']);
                    }
                }
            }

            return response()->json([
                'success' => $isSuccess,
                'status'  => $isSuccess ? 'success' : 'failed',
                'raw_response' => $data['data'] ?? $data,
                'message' => $data['responseMessage'] ?? ($data['status']['message'] ?? 'Transaction not found or pending.')
            ]);

        } catch (\Exception $e) {
            Log::error('[BAKONG] Polling failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Connection to Bakong Node failed.'
            ], 500);
        }
    }

    private function generateDeeplink($qrString)
    {
        try {
            $apiUrl = env('API_GENERATE_DEEPLINK_BAKONG', 'https://api.bakongrelay.com/v1/generate_deeplink_by_qr');
            
            $sourceInfo = [
                'appIconUrl' => env('APP_ICON_URL', 'https://bakong.nbc.gov.kh/images/logo.svg'),
                'appName' => env('APP_NAME', 'ElitePC'),
                'appDeepLinkCallback' => env('APP_URL', 'http://localhost')
            ];

            $response = Http::timeout(5)->post($apiUrl, [
                'qr' => $qrString,
                'sourceInfo' => $sourceInfo
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data']['shortLink'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('[KHQR] Deeplink error: ' . $e->getMessage());
        }
        return null;
    }

    private function calculateCrc16($data)
    {
        $crc = 0xFFFF;
        $jf = 0x1021;
        $length = strlen($data);
        for ($i = 0; $i < $length; $i++) {
            $b = ord($data[$i]);
            for ($j = 0; $j < 8; $j++) {
                $bit = (($b >> (7 - $j)) & 1) == 1;
                $c15 = (($crc >> 15) & 1) == 1;
                $crc <<= 1;
                if ($c15 ^ $bit) {
                    $crc ^= $jf;
                }
            }
        }
        $crc &= 0xFFFF;
        return strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));
    }

    private function generateTlv($tag, $value)
    {
        if ($value === null || $value === '') return '';
        $valueStr = (string) $value;
        $length = str_pad((string) strlen($valueStr), 2, '0', STR_PAD_LEFT);
        return $tag . $length . $valueStr;
    }

    private function generateKhqrString($bankAccount, $merchantName, $merchantCity, $amount, $currency, $billNumber)
    {
        $qr = "";
        $qr .= $this->generateTlv("00", "01"); 
        $qr .= $this->generateTlv("01", "12"); 
        $qr .= $this->generateTlv("29", $this->generateTlv("00", $bankAccount));
        $qr .= $this->generateTlv("52", "5999"); 
        $qr .= $this->generateTlv("53", $currency === 'KHR' ? "116" : "840"); 
        if ($amount !== null && $amount !== '') {
            $amountStr = ($currency === 'KHR') ? (string)round((float)$amount) : number_format((float)$amount, 2, '.', '');
            $qr .= $this->generateTlv("54", $amountStr);
        }
        $qr .= $this->generateTlv("58", "KH");
        $qr .= $this->generateTlv("59", $merchantName);
        $qr .= $this->generateTlv("60", $merchantCity ?: "Phnom Penh");
        $now = (int) round(microtime(true) * 1000);
        $expiry = $now + (86400000 * 1); 
        $tag99inner = $this->generateTlv("00", (string)$now) . $this->generateTlv("01", (string)$expiry);
        $qr .= $this->generateTlv("99", $tag99inner);
        if ($billNumber) $qr .= $this->generateTlv("62", $this->generateTlv("01", $billNumber));
        $qr .= "6304";
        $qr .= $this->calculateCrc16($qr);
        return $qr;
    }

    /**
     * Simulate a successful Bakong payment (Development Only)
     */
    public function simulateSuccess(Request $request)
    {
        if (!config('app.debug')) {
            return response()->json(['success' => false, 'message' => 'Not allowed in production.'], 403);
        }

        $request->validate(['order_id' => 'required|exists:orders,id']);
        
        $order = Order::findOrFail($request->order_id);
        $order->update(['status' => 'paid']);

        UserPayment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'user_id' => auth()->id() ?? $order->user_id,
                'payment_status_id' => 2, // Success
                'amount' => $order->total_amount,
                'currency' => 'USD',
                'paid_at' => now(),
            ]
        );

        return response()->json(['success' => true]);
    }
}

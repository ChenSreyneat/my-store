<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) return redirect()->route('cart.index');
        
        // Prioritize Admin's payment account for checkout
        $paymentAccount = \App\Models\PaymentAccount::whereHas('user', function($q) {
            $q->where('role', 'admin');
        })->where('is_active', true)->first();

        // Fallback to any active account if admin has none (optional, but safer)
        if (!$paymentAccount) {
            $paymentAccount = \App\Models\PaymentAccount::where('is_active', true)->first();
        }
        
        return view('checkout', compact('cartItems', 'paymentAccount'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'phone_number'     => 'required|string|max:30',
            'payment_method'   => 'required|in:cod,card,bakong',
            // Mock card validation
            'card_name'   => 'nullable|required_if:payment_method,card|string|max:255',
            'card_number' => 'nullable|required_if:payment_method,card|string|min:16|max:19',
            'card_expiry' => 'nullable|required_if:payment_method,card|string|size:5',
            'card_cvv'    => 'nullable|required_if:payment_method,card|string|min:3|max:4',
        ]);

        $user      = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) return redirect()->route('cart.index');

        $total = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id'          => $user->id,
                'total_amount'     => $total,
                'shipping_address' => $request->shipping_address,
                'phone_number'     => $request->phone_number,
                'payment_method'   => $request->payment_method,
                'payment_id'       => 'EPC-' . strtoupper(uniqid()),
                'status'           => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
            }

            // Handle simulated Card payment
            if ($request->payment_method === 'card') {
                $order->update(['status' => 'paid']);
                
                // Create a mock payment record
                $paymentAccount = \App\Models\PaymentAccount::where('is_active', true)->first();
                if ($paymentAccount) {
                    \App\Models\UserPayment::create([
                        'order_id'          => $order->id,
                        'user_id'           => $user->id,
                        'payment_method_id' => $paymentAccount->id,
                        'payment_status_id' => 2, // Success
                        'transaction_id'    => 'EPC-CARD-' . strtoupper(bin2hex(random_bytes(4))),
                        'amount'            => $total,
                        'currency'          => 'USD',
                        'paid_at'           => now(),
                    ]);
                }
            }

            // Clear cart
            $user->cartItems()->delete();

            DB::commit();

            if ($request->payment_method === 'bakong') {
                return response()->json([
                    'status'   => 'pay_now',
                    'order_id' => $order->id,
                    'message'  => 'Order created. Please complete Bakong payment.',
                ]);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'order_id' => $order->id,
                    'redirect' => route('order.success', $order),
                ]);
            }

            return redirect()->route('order.success', $order);

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Something went wrong.'], 500);
            }
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function success(Order $order)
    {
        return view('order-success', compact('order'));
    }

    public function myOrders()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();
        return view('my-orders', compact('orders'));
    }
}

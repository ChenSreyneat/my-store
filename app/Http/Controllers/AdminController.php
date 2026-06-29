<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Store;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'stores' => Store::count(),
            'products' => Product::count(),
            'categories' => Category::count(),
            'pending_payouts' => \App\Models\OrderItem::whereHas('order', function($q) {
                $q->where('status', 'completed')->where('is_settled', false);
            })->sum(\DB::raw('quantity * price')),
            'settled_payouts' => \App\Models\OrderItem::whereHas('order', function($q) {
                $q->where('status', 'completed')->where('is_settled', true);
            })->sum(\DB::raw('quantity * price')),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // Category Management
    public function categories(Request $request)
    {
        $categories = Category::withCount('products')->get();
        $editingCategory = $request->edit ? Category::find($request->edit) : null;
        return view('admin.categories', compact('categories', 'editingCategory'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'description' => $request->description,
            'image' => $imagePath,
        ]);
        return back()->with('success', 'Category created.');
    }

    // Brand Management
    public function brands(Request $request)
    {
        $brands = Brand::all();
        $editingBrand = $request->edit ? Brand::find($request->edit) : null;
        return view('admin.brands', compact('brands', 'editingBrand'));
    }

    public function storeBrand(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Brand::create($request->all());
        return back()->with('success', 'Brand created.');
    }

    // Store/Owner Management
    public function stores(Request $request)
    {
        $stores = Store::with('owner')->get();
        $users = User::where('role', 'user')->get();
        $editingStore = $request->edit ? Store::find($request->edit) : null;
        return view('admin.stores', compact('stores', 'users', 'editingStore'));
    }

    public function storeStore(Request $request)
    {
        $request->validate(['name' => 'required', 'email' => 'required|email', 'owner_id' => 'required|exists:users,id']);
        $store = Store::create($request->only('name', 'email'));
        User::where('id', $request->owner_id)->update(['role' => 'owner', 'store_id' => $store->id]);
        return back()->with('success', 'Store created and owner promoted.');
    }

    public function products()
    {
        $products = Product::with(['category', 'brand', 'store'])->latest()->paginate(20);
        return view('admin.products', compact('products'));
    }

    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    public function payments()
    {
        $payments = Order::where('status', 'paid')->latest()->paginate(20);
        return view('admin.payments', compact('payments'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function users(Request $request)
    {
        $query = User::latest();
        if ($request->role) {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(20);
        $editingUser = $request->edit ? User::find($request->edit) : null;
        return view('admin.users', compact('users', 'editingUser'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'role']));
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete yourself!');
        }
        $user->delete();
        return back()->with('success', 'User removed from platform.');
    }

    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted successfully.');
    }


    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($category->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return redirect()->route('admin.categories')->with('success', 'Category updated.');
    }

    public function destroyBrand($id)
    {
        Brand::findOrFail($id)->delete();
        return back()->with('success', 'Brand deleted successfully.');
    }


    public function updateBrand(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);
        $brand->update($request->all());
        return redirect()->route('admin.brands')->with('success', 'Brand updated.');
    }

    // Product Type Management
    public function productTypes(Request $request)
    {
        $types = ProductType::all();
        $editingType = $request->edit ? ProductType::find($request->edit) : null;
        return view('admin.product_types', compact('types', 'editingType'));
    }

    public function storeProductType(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:product_types']);
        ProductType::create(['name' => $request->name]);
        return back()->with('success', 'Product Type created.');
    }

    public function updateProductType(Request $request, $id)
    {
        $type = ProductType::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);
        $type->update($request->all());
        return redirect()->route('admin.product_types')->with('success', 'Product Type updated.');
    }

    public function destroyProductType($id)
    {
        ProductType::findOrFail($id)->delete();
        
        if (ProductType::count() === 0) {
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE product_types AUTO_INCREMENT = 1');
        }

        return back()->with('success', 'Product Type deleted successfully.');
    }

    public function destroyStore($id)
    {
        $store = Store::findOrFail($id);
        User::where('store_id', $store->id)->update(['role' => 'user', 'store_id' => null]);
        $store->delete();
        return back()->with('success', 'Store deleted and owner demoted.');
    }


    public function updateStore(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'owner_id' => 'nullable|exists:users,id'
        ]);

        $store->update($request->only('name', 'email'));

        if ($request->filled('owner_id')) {
            // Find current owner of this store and demote them
            User::where('store_id', $store->id)->update(['role' => 'user', 'store_id' => null]);
            
            // Promote new owner
            User::where('id', $request->owner_id)->update(['role' => 'owner', 'store_id' => $store->id]);
        }

        return redirect()->route('admin.stores')->with('success', 'Store and owner updated.');
    }

    // Payment Account Management
    public function paymentAccounts()
    {
        $accounts = \App\Models\PaymentAccount::with('user')->latest()->get();
        return view('admin.payment_accounts', compact('accounts'));
    }

    public function storePaymentAccount(Request $request)
    {
        $request->validate([
            'account_id' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'currency' => 'required|in:USD,KHR',
        ]);

        \App\Models\PaymentAccount::create([
            'user_id' => Auth::id(),
            'account_id' => $request->account_id,
            'account_name' => $request->account_name,
            'account_city' => $request->account_city ?? 'Phnom Penh',
            'currency' => $request->currency,
            'is_active' => true,
        ]);

        return back()->with('success', 'Payment account registered.');
    }

    public function destroyPaymentAccount($id)
    {
        \App\Models\PaymentAccount::findOrFail($id)->delete();
        return back()->with('success', 'Payment account removed.');
    }

    public function impersonate($id)
    {
        $user = User::findOrFail($id);
        
        // Save current admin ID in session
        session(['admin_impersonator_id' => Auth::id()]);
        
        Auth::login($user);
        
        return redirect()->route('home')->with('success', 'Now impersonating ' . $user->name);
    }

    public function stopImpersonating()
    {
        $adminId = session('admin_impersonator_id');
        
        if ($adminId) {
            $admin = User::findOrFail($adminId);
            Auth::login($admin);
            session()->forget('admin_impersonator_id');
            return redirect()->route('admin.dashboard')->with('success', 'Platform access restored.');
        }
        
        return redirect()->route('home');
    }

    public function reports()
    {
        // Monthly Revenue (Last 6 Months)
        $monthlyRevenue = Order::where('status', 'paid')
            ->selectRaw('SUM(total_amount) as total, MONTHNAME(created_at) as month, MONTH(created_at) as month_num')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month', 'month_num')
            ->orderBy('month_num')
            ->get();

        // Orders count
        $orderStats = Order::selectRaw('COUNT(*) as count, status')
            ->groupBy('status')
            ->get();

        // Top Selling Products
        $topProducts = \App\Models\OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Store Performance
        $storePerformance = Store::withCount('products')
            ->get()
            ->map(function($store) {
                $store->revenue = Order::whereHas('items.product', function($q) use ($store) {
                    $q->where('store_id', $store->id);
                })->where('status', 'paid')->sum('total_amount');
                return $store;
            })->sortByDesc('revenue');

        // Product Payout Report Details
        $productPayouts = Product::with('store')
            ->get()
            ->map(function($product) {
                // Calculate settled sales (completed and settled orders)
                $settledSales = \App\Models\OrderItem::where('product_id', $product->id)
                    ->whereHas('order', function($q) {
                        $q->where('status', 'completed')->where('is_settled', true);
                    });
                $product->settled_units = $settledSales->sum('quantity');
                $product->settled_payout = $settledSales->sum(\DB::raw('quantity * price'));

                // Calculate pending sales (completed and unsettled orders)
                $pendingSales = \App\Models\OrderItem::where('product_id', $product->id)
                    ->whereHas('order', function($q) {
                        $q->where('status', 'completed')->where('is_settled', false);
                    });
                $product->pending_units = $pendingSales->sum('quantity');
                $product->pending_payout = $pendingSales->sum(\DB::raw('quantity * price'));
                
                $product->total_completed_sold = $product->settled_units + $product->pending_units;

                return $product;
            })
            ->filter(function($product) {
                return $product->total_completed_sold > 0;
            })
            ->sortByDesc('pending_payout');

        return view('admin.reports', compact('monthlyRevenue', 'orderStats', 'topProducts', 'storePerformance', 'productPayouts'));
    }

    public function storeOrders($id)
    {
        $store = Store::findOrFail($id);
        $orders = Order::whereHas('items.product', function($q) use ($id) {
            $q->where('store_id', $id);
        })->where('is_settled', false)->with(['user', 'items.product'])->latest()->paginate(20);
        
        $paidOrders = Order::whereHas('items.product', function($q) use ($id) {
            $q->where('store_id', $id);
        })->where('status', 'completed')->where('is_settled', false)->with('items.product')->get();
        
        $payoutTotal = 0;
        foreach ($paidOrders as $order) {
            foreach ($order->items as $item) {
                if ($item->product->store_id == $store->id) {
                    $payoutTotal += $item->price * $item->quantity;
                }
            }
        }
        
        return view('admin.store_orders', compact('store', 'orders', 'paidOrders', 'payoutTotal'));
    }

    public function payoutStore($id)
    {
        $store = Store::with('paymentAccount')->findOrFail($id);
        
        if (!$store->paymentAccount) {
            return response()->json(['success' => false, 'message' => 'Store has no payment account linked.']);
        }

        $paidOrders = Order::whereHas('items.product', function($q) use ($id) {
            $q->where('store_id', $id);
        })->where('status', 'completed')->where('is_settled', false)->with('items.product')->get();

        if ($paidOrders->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No unpaid orders available for payout.']);
        }

        $payoutTotal = 0;
        foreach ($paidOrders as $order) {
            foreach ($order->items as $item) {
                if ($item->product->store_id == $store->id) {
                    $payoutTotal += $item->price * $item->quantity;
                }
            }
        }

        $currency = $store->paymentAccount->currency ?? 'USD';
        $displayAmount = ($currency === 'USD') ? round($payoutTotal, 2) : round($payoutTotal * 4100, 0);

        $khqrString = \App\Http\Controllers\BakongController::generateKhqrString(
            $store->paymentAccount->account_id,
            $store->paymentAccount->account_name,
            $store->paymentAccount->account_city ?? 'Phnom Penh',
            $displayAmount,
            $currency,
            'PAYOUT-' . $store->id . '-' . time()
        );

        $qrImage = null;
        try {
            $relayUrl = env('API_GENERATE_QR_BAKONG', 'https://api.bakongrelay.com/v1/generate_khqr_image');
            $templateUrl = env('QR_TEMPLATE_URL', 'https://raw.githubusercontent.com/bsthen/bakong-khqr/main/bakong_khqr/template.png');

            $relayResponse = \Illuminate\Support\Facades\Http::timeout(10)->post($relayUrl, [
                'qr' => $khqrString,
                'source' => $templateUrl
            ]);

            if ($relayResponse->successful()) {
                $rawBody = $relayResponse->body();
                if (str_starts_with(trim($rawBody), '{')) {
                    $json = json_decode($rawBody, true);
                    $imageData = $json['data'] ?? $json['qr_image'] ?? $json['image'] ?? null;
                    if (is_array($imageData)) {
                        $imageData = $imageData['image'] ?? $imageData['base64'] ?? $imageData['url'] ?? $imageData['data'] ?? null;
                    }
                    if (is_string($imageData) && !str_starts_with(trim($imageData), '{')) {
                        $qrImage = str_starts_with($imageData, 'data:image') ? $imageData : 'data:image/png;base64,' . $imageData;
                    }
                }
                
                if (!$qrImage) {
                    $qrImage = 'data:image/png;base64,' . base64_encode($rawBody);
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('[KHQR] Relay API failed: ' . $e->getMessage());
        }

        if (!$qrImage) {
            $qrImage = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($khqrString);
        }
        
        return response()->json([
            'success' => true,
            'qr_url' => $qrImage,
            'account_id' => $store->paymentAccount->account_id,
            'account_name' => $store->paymentAccount->account_name,
            'md5' => md5($khqrString)
        ]);
    }

    public function checkPayoutMd5(Request $request, $id)
    {
        $request->validate(['md5' => 'required|string']);
        
        $token = env('BAKONG_API_TOKEN');
        $baseUrl = env('BAKONG_BASE_URL', 'https://api-bakong.nbc.org.kh');
        
        if (!$token) {
            // Simulate success for demo if no token
            $this->markOrdersSettled($id);
            return response()->json(['success' => true, 'message' => 'Simulated success (No token).']);
        }
        
        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type'  => 'application/json'
            ])->timeout(10)->post($baseUrl . '/v1/check_transaction_by_md5', [
                'md5' => $request->md5
            ]);

            $data = $response->json();
            $responseCode = $data['responseCode'] ?? ($data['status']['code'] ?? null);
            $isSuccess = ($responseCode === 0 || $responseCode === '0' || $responseCode === '00');

            if ($isSuccess) {
                $this->markOrdersSettled($id);
            }

            return response()->json([
                'success' => $isSuccess,
                'message' => $isSuccess ? 'Payout verified successfully!' : 'Transaction not found or pending.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Connection to Bakong failed.']);
        }
    }

    private function markOrdersSettled($storeId)
    {
        $paidOrders = Order::whereHas('items.product', function($q) use ($storeId) {
            $q->where('store_id', $storeId);
        })->with(['items.product'])->where('status', 'completed')->where('is_settled', false)->get();

        if ($paidOrders->isEmpty()) return;

        $payoutTotal = 0;
        $productTotals = [];

        foreach ($paidOrders as $order) {
            foreach ($order->items as $item) {
                if ($item->product->store_id == $storeId) {
                    $itemTotal = $item->price * $item->quantity;
                    $payoutTotal += $itemTotal;

                    if (!isset($productTotals[$item->product_id])) {
                        $productTotals[$item->product_id] = [
                            'quantity' => 0,
                            'amount' => 0,
                        ];
                    }
                    $productTotals[$item->product_id]['quantity'] += $item->quantity;
                    $productTotals[$item->product_id]['amount'] += $itemTotal;
                }
            }
            $order->update(['is_settled' => true]);
        }

        if ($payoutTotal > 0) {
            $payout = \App\Models\Payout::create([
                'store_id' => $storeId,
                'amount' => $payoutTotal,
            ]);

            foreach ($productTotals as $productId => $totals) {
                \App\Models\PayoutItem::create([
                    'payout_id' => $payout->id,
                    'product_id' => $productId,
                    'quantity' => $totals['quantity'],
                    'amount' => $totals['amount'],
                ]);
            }
        }
    }

    public function settlement()
    {
        $stores = Store::with(['owner', 'paymentAccount'])->get()->map(function($store) {
            // Calculate total revenue for this store from completed orders
            $store->total_revenue = \App\Models\OrderItem::whereHas('product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })->whereHas('order', function($q) {
                $q->where('status', 'completed')->where('is_settled', false);
            })->sum(\DB::raw('quantity * price'));
            
            return $store;
        });

        return view('admin.settlement', compact('stores'));
    }
    public function payouts()
    {
        $payouts = \App\Models\Payout::with('store')->latest()->paginate(20);
        return view('admin.payouts.index', compact('payouts'));
    }

    public function showPayout($id)
    {
        $payout = \App\Models\Payout::with(['store', 'items.product'])->findOrFail($id);
        return view('admin.payouts.show', compact('payout'));
    }
}

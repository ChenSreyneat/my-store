<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $store = Auth::user()->store;
        $stats = [
            'products' => Product::where('store_id', $store->id)->count(),
            'orders' => Order::whereHas('items.product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })->count(),
            'stock' => Product::where('store_id', $store->id)->sum('stock'),
        ];
        $recentOrders = Order::whereHas('items.product', function($q) use ($store) {
            $q->where('store_id', $store->id);
        })->with(['user', 'items.product'])->latest()->limit(5)->get();

        return view('owner.dashboard', compact('stats', 'recentOrders'));
    }

    public function products(Request $request)
    {
        $store = Auth::user()->store;
        $products = Product::where('store_id', $store->id)->with(['category', 'brand', 'productType'])->get();
        $categories = Category::all();
        $brands = Brand::all();
        $productTypes = \App\Models\ProductType::all();
        $editingProduct = $request->edit ? Product::where('id', $request->edit)->where('store_id', $store->id)->first() : null;
        return view('owner.products', compact('products', 'categories', 'brands', 'productTypes', 'editingProduct'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'product_type_id' => 'required|exists:product_types,id',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:5120',
        ]);

        $data = $request->except(['image', 'images']);
        $data['store_id'] = Auth::user()->store_id;
        
        if ($request->hasFile('images')) {
            $firstImage = $request->file('images')[0];
            $path = $firstImage->store('products', 'public');
            $data['image_url'] = $path;
        }
        
        $product = Product::create($data);
        
        if ($request->hasFile('images')) {
            foreach($request->file('images') as $index => $file) {
                if ($index === 0) {
                    $img_path = $path;
                } else {
                    $img_path = $file->store('products', 'public');
                }
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $img_path,
                    'is_primary' => ($index === 0)
                ]);
            }
        }

        return back()->with('success', 'Hardware unit registered successfully.');
    }

    public function orders(Request $request)
    {
        $store = Auth::user()->store;
        $orders = Order::whereHas('items.product', function($q) use ($store) {
            $q->where('store_id', $store->id);
        })->with(['items.product', 'user'])->latest()->get();
        
        $editingOrder = $request->edit ? Order::find($request->edit) : null;
        return view('owner.orders', compact('orders', 'editingOrder'));
    }

    public function updateOrder(Request $request, $id)
    {
        $storeId = Auth::user()->store_id;
        $order = Order::where('id', $id)->whereHas('items.product', function($q) use ($storeId) {
            $q->where('store_id', $storeId);
        })->firstOrFail();
        
        $order->update($request->only('status'));
        return redirect()->route('owner.orders')->with('success', 'Order status updated.');
    }

    public function payments()
    {
        $store = Auth::user()->store;
        $orders = Order::whereHas('items.product', function($q) use ($store) {
            $q->where('store_id', $store->id);
        })->where('status', 'paid')->with(['items.product', 'user'])->latest()->get();

        $totalEarnings = \App\Models\OrderItem::whereHas('product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->whereHas('order', function($q) {
                $q->where('status', 'paid');
            })
            ->sum(\DB::raw('price * quantity'));
        
        return view('owner.payments', compact('orders', 'totalEarnings'));
    }

    public function settings()
    {
        $store = Auth::user()->store;
        $paymentAccounts = \App\Models\PaymentAccount::where('user_id', Auth::id())->get();
        return view('owner.settings', compact('store', 'paymentAccounts'));
    }

    public function updateSettings(Request $request)
    {
        $store = Auth::user()->store;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'payment_account_id' => 'nullable|exists:payment_accounts,id'
        ]);

        $store->update($request->all());
        return back()->with('success', 'Store settings updated.');
    }

    public function destroyProduct($id)
    {
        $product = Product::where('id', $id)->where('store_id', Auth::user()->store_id)->firstOrFail();
        $product->delete();
        return back()->with('success', 'Product removed from inventory.');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('id', $id)->where('store_id', Auth::user()->store_id)->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'product_type_id' => 'required|exists:product_types,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
        ]);

        $data = $request->except(['image', 'images']);
        
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->image_url) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_url);
            }
            
            $oldImages = \App\Models\ProductImage::where('product_id', $product->id)->get();
            foreach($oldImages as $oldImg) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldImg->image_url);
                $oldImg->delete();
            }
            
            $firstImage = $request->file('images')[0];
            $path = $firstImage->store('products', 'public');
            $data['image_url'] = $path;

            foreach($request->file('images') as $index => $file) {
                if ($index === 0) {
                    $img_path = $path;
                } else {
                    $img_path = $file->store('products', 'public');
                }
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $img_path,
                    'is_primary' => ($index === 0)
                ]);
            }
        }
        
        $product->update($data);
        return redirect()->route('owner.products')->with('success', 'Product updated successfully.');
    }

    // Payment Account Management
    public function paymentAccounts()
    {
        $accounts = \App\Models\PaymentAccount::where('user_id', Auth::id())->latest()->get();
        return view('owner.payment_accounts', compact('accounts'));
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
        \App\Models\PaymentAccount::where('id', $id)->where('user_id', Auth::id())->firstOrFail()->delete();
        return back()->with('success', 'Payment account removed.');
    }

    public function reports()
    {
        $store = Auth::user()->store;

        // Store Monthly Revenue
        $monthlyRevenue = \App\Models\OrderItem::whereHas('product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->whereHas('order', function($q) {
                $q->where('status', 'paid');
            })
            ->selectRaw('SUM(price * quantity) as total, MONTHNAME(created_at) as month, MONTH(created_at) as month_num')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month', 'month_num')
            ->orderBy('month_num')
            ->get();

        // Top Store Products
        $topProducts = \App\Models\OrderItem::whereHas('product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->selectRaw('product_id, SUM(quantity) as total_sold')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Recent Activity
        $recentOrders = Order::whereHas('items.product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })->with(['user', 'items.product'])->latest()->limit(10)->get();

        return view('owner.reports', compact('monthlyRevenue', 'topProducts', 'recentOrders'));
    }

    public function users()
    {
        $store = Auth::user()->store;
        
        // Customers are users who have ordered from this store
        $users = \App\Models\User::whereHas('orders.items.product', function($q) use ($store) {
            $q->where('store_id', $store->id);
        })->withCount(['orders' => function($q) use ($store) {
            $q->whereHas('items.product', function($sq) use ($store) {
                $sq->where('store_id', $store->id);
            });
        }])->get();

        return view('owner.users', compact('users'));
    }
}

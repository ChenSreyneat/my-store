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
        $request->validate(['name' => 'required|string|max:255|unique:categories']);
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
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
        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->all());
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
        $store->update($request->all());
        return redirect()->route('admin.stores')->with('success', 'Store updated.');
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

        return view('admin.reports', compact('monthlyRevenue', 'orderStats', 'topProducts', 'storePerformance'));
    }

    public function settlement()
    {
        $stores = Store::with(['owner', 'paymentAccount'])->get()->map(function($store) {
            // Calculate total revenue for this store from paid orders
            $store->total_revenue = \App\Models\OrderItem::whereHas('product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })->whereHas('order', function($q) {
                $q->where('status', 'paid');
            })->sum(\DB::raw('quantity * price'));
            
            return $store;
        });

        return view('admin.settlement', compact('stores'));
    }
}

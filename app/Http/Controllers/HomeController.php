<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with(['category', 'store', 'images'])
            ->latest()
            ->take(8)
            ->get();

        $newArrivals = Product::where('is_active', true)
            ->with(['category', 'store', 'images'])
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('products')->get();

        return view('home', compact('featuredProducts', 'newArrivals', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function category(Request $request, Category $category)
    {
        $query = Product::where('category_id', $category->id)
            ->where('is_active', true);

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->has('product_type_id')) {
            $query->where('product_type_id', $request->product_type_id);
        }

        $products = $query->with(['brand', 'productType', 'store', 'images'])
            ->paginate(12)
            ->withQueryString();

        $brands = \App\Models\Brand::all();
        $productTypes = \App\Models\ProductType::all();

        return view('category', compact('category', 'products', 'brands', 'productTypes'));
    }

    public function productDetails(Product $product)
    {
        $product->load(['category', 'brand', 'store', 'images']);
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)->get();

        return view('product-details', compact('product', 'related'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Product $product)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'unauthenticated',
                'redirect' => route('login'),
                'message' => 'Please login to add favorites.'
            ], 401);
        }

        $user = Auth::user();
        $user->favorites()->toggle($product->id);
        $isFavorited = $user->favorites()->where('product_id', $product->id)->exists();

        return response()->json([
            'favorited' => $isFavorited,
            'message'   => $isFavorited ? 'Added to favorites' : 'Removed from favorites',
        ]);
    }

    public function index()
    {
        $favorites = Auth::user()->favorites()->with(['category', 'store', 'images'])->get();
        return view('favorites', compact('favorites'));
    }
}

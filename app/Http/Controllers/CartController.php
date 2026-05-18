<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product.images')->get();
        return view('cart', compact('cartItems'));
    }

    public function add(Product $product)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'status' => 'unauthenticated',
                'redirect' => route('login'),
                'message' => 'Please login to add items to cart.'
            ], 401);
        }

        $user = Auth::user();

        if ($product->stock <= 0) {
            return response()->json(['success' => false, 'message' => 'Out of stock'], 400);
        }

        $cartItem = CartItem::firstOrNew([
            'user_id'    => $user->id,
            'product_id' => $product->id,
        ]);

        $cartItem->quantity = ($cartItem->exists ? $cartItem->quantity : 0) + 1;
        $cartItem->save();

        $product->decrement('stock');

        $cartCount = $user->cartItems()->sum('quantity');

        return response()->json([
            'success'   => true,
            'message'   => 'Add to cart',
            'cartCount' => $cartCount,
        ]);
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $diff = $request->quantity - $cartItem->quantity;
        $product = $cartItem->product;

        if ($diff > 0 && $product->stock < $diff) {
            return back()->with('error', 'Not enough stock.');
        }

        $product->increment('stock', -$diff);
        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->product->increment('stock', $cartItem->quantity);
        $cartItem->delete();
        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        $user = Auth::user();
        foreach ($user->cartItems()->with('product')->get() as $item) {
            $item->product->increment('stock', $item->quantity);
            $item->delete();
        }
        return back()->with('success', 'Cart cleared.');
    }
}

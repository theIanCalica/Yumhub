<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'food_ID' => 'required|exists:foods,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $userId = $validatedData['user_id'];
        $foodId = $validatedData['food_ID'];

        // Find or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Find or create a cart item
        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'food_id' => $foodId
        ]);

        // Update or set the quantity
        $cartItem->qty = $cartItem->qty ? $cartItem->qty + 1 : 1;
        $cartItem->save();
        return response()->json(['message' => 'Cart updated successfully'], 200);
    }

    public function getCartItems(Request $request)
    {
        $cartItems = CartItem::whereHas('cart', function ($query) use ($request) {
            $query->where('user_id', $request->user_id);
        })
            ->with('food')  // Eager load the related food items
            ->get();

        return response()->json($cartItems);
    }
}

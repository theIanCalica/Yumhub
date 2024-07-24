<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cartItem = CartItem::FindOrFail($id);
        $cartItem->qty = $request->quantity;
        $cartItem->update();
        return response()->json(["message" => $cartItem]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = CartItem::FindOrFail($id);
        $cartItem->delete();
        return response()->json(["message" => "success"]);
    }

    public function getCartItems(Request $request)
    {
        $cart = Cart::where("user_id", $request->user_id)->first();
        $cartItems = $cart->items()->with(['food.cuisine', 'food.category'])->get();
        return response()->json($cartItems);
    }
}

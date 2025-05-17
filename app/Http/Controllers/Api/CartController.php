<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index() {
        return CartItem::with('property')->where('user_id', auth()->id())->get();
    }

    public function add(Request $request) {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::updateOrCreate(
            ['user_id' => auth()->id(), 'property_id' => $request->property_id],
            ['quantity' => DB::raw('quantity + ' . $request->quantity)]
        );

        return response()->json(['message' => 'Item added to cart.', 'item' => $cartItem]);
    }

    public function remove($id) {
        $item = CartItem::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $item->delete();
        return response()->json(['message' => 'Item removed from cart.']);
    }

    public function clear() {
        CartItem::where('user_id', auth()->id())->delete();
        return response()->json(['message' => 'Cart cleared.']);
    }
}

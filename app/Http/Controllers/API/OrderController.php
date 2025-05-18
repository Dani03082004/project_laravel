<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function checkout() {
        $cartItems = CartItem::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Carrito esta vacío.'], 400);
        }

        $order = Order::create(['user_id' => auth()->id()]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'property_id' => $item->property_id,
                'quantity' => $item->quantity,
            ]);
        }

        CartItem::where('user_id', auth()->id())->delete();

        return response()->json(['message' => 'Pedido creado correctamente.']);
    }

    public function index() {
        $orders = Order::with(['items.property'])->where('user_id', auth()->id())->get();
        return response()->json($orders);
    }
}


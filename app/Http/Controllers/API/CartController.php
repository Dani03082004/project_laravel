<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                return response()->json(['error' => 'User no autenticado'], 401);
            }

            $cartItems = CartItem::with('property')
                ->where('user_id', $userId)
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'ok' => true,
                    'mensaje' => 'El carrito está vacío',
                    'items' => []
                ]);
            }

            return response()->json([
                'ok' => true,
                'items' => $cartItems
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'linea' => $e->getLine(),
                'archivo' => $e->getFile(),
            ], 500);
        }
    }

    public function add(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $existing = CartItem::where('user_id', auth()->id())
            ->where('property_id', $request->property_id)
            ->first();

        if ($existing) {
            $existing->quantity += $request->quantity;
            $existing->save();
            $cartItem = $existing;
        } else {
            $cartItem = CartItem::create([
                'user_id' => auth()->id(),
                'property_id' => $request->property_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json([
            'message' => 'Propiedad añadida al carrito.',
            'item' => $cartItem
        ]);
    }

    public function remove($id)
    {
        $item = CartItem::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $item->delete();
        return response()->json(['message' => 'Propiedad eliminada del carrito.']);
    }

    public function clear()
    {
        CartItem::where('user_id', auth()->id())->delete();
        return response()->json(['message' => 'Carrito vacío.']);
    }
}

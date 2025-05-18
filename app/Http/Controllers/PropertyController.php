<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); // funciona con auth:sanctum

        if ($user->hasRole('admin')) {
            $properties = Property::all();
        } elseif ($user->hasRole('member')) {
            $properties = Property::where('user_id', $user->id)->get();
        } else {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json($properties, 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!($user->hasRole('admin') || $user->hasRole('member'))) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:sale,rent',
            'location' => 'required|string|max:255',
            'size' => 'required|integer|min:10',
        ]);

        $property = new Property($validated);
        $property->user_id = $user->id;
        $property->save();

        return response()->json(['message' => 'Propiedad creada correctamente', 'property' => $property], 201);
    }

    public function show(Property $property)
    {
        $user = Auth::user();

        if ($user->hasRole('admin') || ($user->hasRole('member') && $property->user_id === $user->id)) {
            return response()->json(['property' => $property], 200);
        }

        return response()->json(['message' => 'No autorizado'], 403);
    }

    public function update(Request $request, Property $property)
    {
        $user = Auth::user();

        if (!($user->hasRole('admin') || ($user->hasRole('member') && $property->user_id === $user->id))) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:sale,rent',
            'location' => 'required|string|max:255',
            'size' => 'required|integer|min:10',
        ]);

        $property->update($validated);

        return response()->json(['message' => 'Propiedad actualizada', 'property' => $property], 200);
    }

    public function destroy(Property $property)
    {
        $user = Auth::user();

        if (!($user->hasRole('admin') || ($user->hasRole('member') && $property->user_id === $user->id))) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $property->delete();

        return response()->json(['message' => 'Propiedad eliminada'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $properties = Property::all();
        } elseif ($user->hasRole('member')){
            $properties = Property::where('user_id', $user->id)->get();
        }

        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles(['admin', 'member']);
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles(['admin', 'member']);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:sale,rent',
            'location' => 'required|string|max:255',
            'size' => 'required|integer|min:10',
        ]);

        $property = new Property();
        $property->title = $request->title;
        $property->description = $request->description;
        $property->price = $request->price;
        $property->status = $request->status;
        $property->location = $request->location;
        $property->size = $request->size;
        $property->user_id = Auth::id();

        $property->save();

        return redirect()->route('properties.index')->with('success', 'Propiedad creada correctamente');
    }

    public function show(Property $property)
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $properties = Property::all();
        } elseif ($user->hasRole('member')) {
            $properties = Property::where('user_id', $user->id)->get();
        }

        return view('properties.show', compact('properties'));
    }

    public function edit(Property $property)
    {
        $user = Auth::user();
        $user->authorizeRoles(['admin', 'member']);

        if ($user->id !== $property->user_id && !$user->hasRole('admin')) {
            abort(403);
        }

        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $user = Auth::user();
        $user->authorizeRoles(['admin', 'member']);

        if ($user->id !== $property->user_id && !$user->hasRole('admin')) {
            abort(403);
        }

        // Validación de los datos
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:sale,rent',
            'location' => 'required|string|max:255',
            'size' => 'required|integer|min:10',
        ]);

        // Si la validación pasa, actualizamos la propiedad
        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'location' => $request->location,
            'size' => $request->size,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('properties.show', $property)->with('success', 'Propiedad actualizada');
    }


    public function destroy(Property $property)
    {
        $user = Auth::user();
        $user->authorizeRoles(['admin']);

        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada');
    }
}

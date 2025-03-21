<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller{

    public function index()
    {
        $properties = Property::where('user_id', Auth::id())->get();
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        $user = Auth::user();
        dd($user);
        $user->authorizeRoles(['admin', 'member']);
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        dd($user);
        $user->authorizeRoles(['admin', 'member']);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:sale,rent',
            'location' => 'required|string|max:255',
            'size' => 'required|integer|min:10',
        ]);

        $property = new Property($request->all());
        $property->user_id = Auth::id();
        $property->save();

        return redirect()->route('properties.index')->with('success', 'Propiedad creada correctamente');
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $user = Auth::user();
        dd($user);
        $user->authorizeRoles(['admin', 'member']);

        if ($user->id !== $property->user_id && !$user->hasRole('admin')) {
            abort(403);
        }

        return view('properties.edit', compact('properties'));
    }

    public function update(Request $request, Property $property)
    {
        $user = Auth::user();
        dd($user);
        $user->authorizeRoles(['admin', 'member']);

        if ($user->id !== $property->user_id && !$user->hasRole('admin')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:sale,rent',
            'location' => 'required|string|max:255',
            'size' => 'required|integer|min:10',
        ]);

        $property->update($request->all());

        return redirect()->route('properties.index')->with('success', 'Propiedad actualizada');
    }

    public function destroy(Property $property)
    {
        $user = Auth::user();
        dd($user);
        $user->authorizeRoles(['admin']);

        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Propiedad eliminada');
    }
}

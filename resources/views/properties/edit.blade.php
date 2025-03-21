@extends('layouts.app')

@section('content')
    <h1>Editar Propiedad</h1>
    <form action="{{ route('properties.update', $property) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="title" value="{{ $property->title }}" required>
        <textarea name="description" required>{{ $property->description }}</textarea>
        <input type="number" name="price" value="{{ $property->price }}" required>
        <select name="type">
            <option value="sale" {{ $property->type == 'sale' ? 'selected' : '' }}>Venta</option>
            <option value="rent" {{ $property->type == 'rent' ? 'selected' : '' }}>Alquiler</option>
        </select>
        <input type="text" name="location" value="{{ $property->location }}" required>
        <button type="submit">Actualizar</button>
    </form>
@endsection

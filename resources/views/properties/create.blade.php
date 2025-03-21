@extends('layouts.app')

@section('content')
    <h1>Crear Propiedad</h1>
    <form action="{{ route('properties.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Título" required>
        <textarea name="description" placeholder="Descripción" required></textarea>
        <input type="number" name="price" placeholder="Precio" required>
        <select name="type">
            <option value="sale">Venta</option>
            <option value="rent">Alquiler</option>
        </select>
        <input type="text" name="location" placeholder="Ubicación" required>
        <button type="submit">Guardar</button>
    </form>
@endsection

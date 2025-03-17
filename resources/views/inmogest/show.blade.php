@extends('layouts.app')

@section('content')
    <h1>{{ $property->title }}</h1>
    <p>{{ $property->description }}</p>
    <p>Precio: {{ $property->price }}</p>
    <p>Tipo: {{ ucfirst($property->type) }}</p>
    <p>Ubicación: {{ $property->location }}</p>
    <a href="{{ route('properties.index') }}" class="btn btn-secondary">Volver</a>
@endsection

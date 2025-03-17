@extends('layouts.app')

@section('content')
    <h1>Propiedades</h1>
    @can('create', App\Models\Property::class)
        <a href="{{ route('properties.create') }}" class="btn btn-primary">Añadir Propiedad</a>
    @endcan
    <ul>
        @foreach ($properties as $property)
            <li>
                <a href="{{ route('properties.show', $property) }}">{{ $property->title }}</a>

                @can('update', $property)
                    <a href="{{ route('properties.edit', $property) }}" class="btn btn-warning">Editar</a>
                @endcan

                @can('delete', $property)
                    <form action="{{ route('properties.destroy', $property) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>
@endsection

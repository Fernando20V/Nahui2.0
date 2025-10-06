@extends('app')

@section('content')
<div class="places-container">
    <div class="header-bar">
        <h1>Lugares registrados</h1>
   <a href="{{ route('places.create') }}" class="btn-create" title="Crear nuevo lugar">
        <i class="fa-solid fa-plus"></i> Crear lugar
    </a>    </div>

    @if(session('success'))
        <div class="flash-message success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table class="places-table">
            <thead>
                <tr class="head">
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($places as $place)
                <tr>
                    <td>{{ $place->name }}</td>
                    <td>{{ $place->placeCategory->name ?? '—' }}</td>
                    <td class="descripcion">{{ $place->description }}</td>
                    <td class="text-center">
                        @if($place->is_public)
                            <span class="badge public">Público</span>
                        @else
                            <span class="badge private">Privado</span>
                        @endif
                    </td>
<td class="action-buttons">
    <a href="{{ route('places.show', $place->id) }}" class="icon-btn view" title="Ver">
        Ver <i class="fa-solid fa-eye"></i>
    </a>
    <a href="{{ route('places.edit', $place->id) }}" class="icon-btn edit" title="Editar">
       Editar <i class="fa-solid fa-pen-to-square"></i>
    </a>
<x-boton-eliminar :id="$place->id" />

</td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-6">No hay lugares registrados aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

<div class="places-pagination">
    {{ $places->links('vendor.pagination.places') }}
</div>

</div>
@endsection

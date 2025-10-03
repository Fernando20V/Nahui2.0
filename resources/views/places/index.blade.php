@extends('app')

@section('content')
<div class="places-container">
    <h1>Lugares Registrados</h1>

    @if(session('success'))
        <div class="flash-message success">
            {{ session('success') }}
        </div>
    @endif

    <div class="places-table">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Ubicación</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($places as $place)
                <tr>
                    <td>{{ $place->name }}</td>
                    <td>{{ $place->placeCategory->name ?? '—' }}</td>
                    <td>{{ $place->address->full_address ?? '—' }}</td>
                    <td class="text-center">
                        @if($place->is_public)
                            <span class="badge public">Público</span>
                        @else
                            <span class="badge private">Privado</span>
                        @endif
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('places.show', $place->id) }}" class="view">Ver</a>
                        <a href="{{ route('places.edit', $place->id) }}" class="edit">Editar</a>
                        <form action="{{ route('places.destroy', $place->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete"
                                onclick="return confirm('¿Deseas eliminar este lugar?')">Eliminar</button>
                        </form>
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
        {{ $places->links('pagination::tailwind') }}
    </div>
</div>
@endsection

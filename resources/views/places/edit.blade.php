@extends('app')

@section('content')
<div class="publicar-container">
    <h1 class="place_title">Editar lugar</h1>
    @include('places.form', [
        'action' => route('places.update', $place->id),
        'method' => 'PUT',
        'place' => $place
    ])
</div>
@endsection

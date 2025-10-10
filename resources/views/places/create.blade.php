@extends('app')

@section('content')
<div class="publicar-container">
    <h1 class="place_title">Crear nuevo lugar</h1>
    @include('places.form', ['action' => route('places.store')])
</div>
@endsection

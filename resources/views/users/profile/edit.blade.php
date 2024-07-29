@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    <x-widget.card icon="fas fa-id-card " title="Mis Datos">
        @include('users.partials.form', [
            'method' => 'PUT',
            'route' => route('users.profile.update'),
            'model' => 'supplier',
        ])
    </x-widget.card>
@stop

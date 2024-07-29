@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    <x-widget.card icon="fas fa-id-card " title="Mis Datos">
        @include('users.partials.form', [
            'method' => null,
            'route' => null,
            'model' => 'supplier',
        ])
        @include('include.js.btn-edit-in-show', [
            'route' => 'users.profile.edit',
        ])
    </x-widget.card>
@stop

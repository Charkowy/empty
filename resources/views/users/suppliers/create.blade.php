@extends('adminlte::page')
@section('content_header')
    <h1 class="m-0 text-dark">Proveedores</h1>
@stop
@section('content')
    <x-widget.alert />
    @include('users.partials.form', [
        'method' => 'POST',
        'route' => route('users.suppliers.store'),
        'model' => 'supplier',
    ])
@stop

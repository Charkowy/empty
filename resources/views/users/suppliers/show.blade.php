@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    @include('users.partials.form', [
        'method' => null,
        'route' => null,
        'model' => 'supplier',
    ])
    @include('include.js.btn-edit-in-show', [
        'route' => 'users.suppliers.edit',
        'route_params' => $supplier->id,
    ])
@stop

@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    @include('users.partials.form', [
        'method' => null,
        'route' => null,
        'model' => 'customer',
    ])
    @include('include.js.btn-edit-in-show', [
        'route' => 'users.customers.edit',
        'route_params' => $customer->id,
    ])
@stop

@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('users.partials.form', [
        'method' => 'PUT',
        'route' => route('users.customers.update', $customer->id),
        'model' => 'customer',
    ])
@stop

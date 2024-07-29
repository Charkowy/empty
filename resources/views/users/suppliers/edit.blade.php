@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('users.partials.form', [
        'method' => 'PUT',
        'route' => route('users.suppliers.update', $supplier->id),
        'model' => 'supplier',
    ])
@stop

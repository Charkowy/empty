@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('products.crud.partials.form', [
        'method' => 'POST',
        'route' => route('products.crud.store'),
    ])
@stop

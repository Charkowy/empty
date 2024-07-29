@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('products.crud.partials.form', [
        'method' => null,
        'route' => null,
    ])
@stop

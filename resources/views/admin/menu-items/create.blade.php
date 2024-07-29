@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    @include('admin.menu-items.partials.form', [
        'method' => 'POST',
        'route' => route('admin.menu-items.store'),
    ])
@stop

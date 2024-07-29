@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    @include('admin.permissions.partials.form', [
        'method' => 'POST',
        'route' => route('admin.permissions.store'),
    ])
@stop

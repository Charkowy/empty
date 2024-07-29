@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    @include('admin.roles.partials.form', [
        'method' => 'POST',
        'route' => route('admin.roles.store'),
    ])
@stop

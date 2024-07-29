@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.roles.partials.form', [
        'method' => null,
        'route' => null,
    ])
@stop

@include('include.js.btn-edit-in-show', [
    'route' => 'admin.roles.edit',
    'route_params' => $role->id,
])

@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.permissions.partials.form', [
        'method' => null,
        'route' => null,
    ])
@stop

@include('include.js.btn-edit-in-show', [
    'route' => 'admin.permissions.edit',
    'route_params' => $permission->id,
])

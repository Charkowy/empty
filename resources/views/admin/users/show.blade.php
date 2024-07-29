@extends('adminlte::page')
@section('content')
    <x-widget.alert />
    @include('admin.users.partials.form', [
        'method' => null,
        'route' => null,
        'model' => 'user',
    ])
    @include('include.js.btn-edit-in-show', [
        'route' => 'admin.users.edit',
        'route_params' => $user->id,
    ])
@stop

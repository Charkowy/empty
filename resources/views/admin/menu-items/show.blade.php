@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.menu-items.partials.form', [
        'method' => null,
        'route' => null,
    ])
@stop

@include('include.js.btn-edit-in-show', [
    'route' => 'admin.menu-items.edit',
    'route_params' => $menu_item->id,
])

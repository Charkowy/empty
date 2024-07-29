@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.menu-items.partials.form', [
        'method' => 'PUT',
        'route' => route('admin.menu-items.update', $menu_item->id),
    ])
@stop

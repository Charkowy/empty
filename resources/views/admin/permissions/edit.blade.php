@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.permissions.partials.form', [
        'method' => 'PUT',
        'route' => route('admin.permissions.update', $permission->id),
    ])
@stop

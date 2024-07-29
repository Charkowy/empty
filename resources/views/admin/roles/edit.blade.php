@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.roles.partials.form', [
        'method' => 'PUT',
        'route' => route('admin.roles.update', $role->id),
    ])
@stop

@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.users.partials.form', [
        'method' => 'POST',
        'route' => route('admin.users.store'),
        'model' => 'user',
    ])
@stop

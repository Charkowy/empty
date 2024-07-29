@extends('adminlte::page')

@section('content')
    <x-widget.alert />
    @include('admin.users.partials.form', [
        'method' => 'PUT',
        'route' => route('admin.users.update', $user->id),
        'model' => 'user',
    ])
@stop

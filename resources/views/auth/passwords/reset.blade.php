@extends('adminlte::auth.passwords.reset')
@section('password_reset_url', 'reset-password')
@php
    $token = request()->route('token');
@endphp

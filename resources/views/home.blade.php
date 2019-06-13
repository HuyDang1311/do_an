@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p><b>Xin chào: {{ \Illuminate\Support\Facades\Auth::user()->name ?? '' }}</b></p>
    <p><b>Đăng nhập thành công!</b></p>
@stop

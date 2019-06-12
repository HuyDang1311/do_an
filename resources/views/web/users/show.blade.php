@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.users.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.users.name') : {{ $data->name ?? '' }}</b></h2>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="name">@lang('label.users.tr_name') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span  class="form-text">{{ $data->name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="address">@lang('label.users.tr_address') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span  class="form-text">{{ $data->address ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="email">@lang('label.users.tr_email') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->email ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="username">@lang('label.users.tr_username') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->username ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="phone_number">@lang('label.users.tr_phone_number') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->phone_number ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <a class="btn btn-primary pull-left" href="/users/edit"><i class="fa fa-edit"></i>
                    &nbsp;@lang('label.edit')</a>
            </div>
        </div>
        <div class="box-footer with-border"></div>
    </div>
@stop

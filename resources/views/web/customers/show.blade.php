@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.drivers.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.drivers.name') : {{ $data->name ?? '' }}</b></h2>
            <a href="/drivers/index" class="pull-right btn btn-info">
                <i class="fa fa-list" aria-hidden="true"></i>
                &nbsp;@lang('label.drivers.list_drivers')</a>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="name">@lang('label.drivers.tr_name') :</span>
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
                    <span class="form-text" for="email">@lang('label.drivers.tr_email') :</span>
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
                    <span class="form-text" for="username">@lang('label.drivers.tr_username') :</span>
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
                    <span class="form-text" for="address">@lang('label.drivers.tr_address') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->address ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="phone_number">@lang('label.drivers.tr_phone_number') :</span>
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
                <div class="form-group pull-right">
                    <span class="form-text" for="company_id">@lang('label.drivers.tr_company_id') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->company->name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="status">@lang('label.drivers.tr_status') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->status_name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="created_at">@lang('label.drivers.tr_created_at') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->created_at ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-4">
                <a class="btn btn-primary pull-right" href="/drivers/edit/{{ $data['id'] ?? '' }}"><i class="fa fa-edit"></i>
                    &nbsp;@lang('label.edit')</a>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <form method="post" action="/drivers/delete/{{ $data['id'] ?? '' }}">
                    @csrf
                    <button type="submit" class="btn btn-danger pull-left"><i class="fa fa-search"></i>
                        &nbsp;@lang('label.delete')</button>
                </form>
            </div>
            <!-- /.col -->
        </div>
        <div class="box-footer with-border"></div>
    </div>
@stop

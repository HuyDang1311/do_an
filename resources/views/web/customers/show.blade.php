@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.customers.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.customers.name') : {{ $data->name ?? '' }}</b></h2>
            <a href="/customers/index" class="pull-right btn btn-info">
                <i class="fa fa-list" aria-hidden="true"></i>
                &nbsp;@lang('label.customers.list_customers')</a>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="name">@lang('label.customers.tr_name') :</span>
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
                    <span class="form-text" for="email">@lang('label.customers.tr_email') :</span>
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
                    <span class="form-text" for="address">@lang('label.customers.tr_address') :</span>
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
                    <span class="form-text" for="phone_number">@lang('label.customers.tr_phone_number') :</span>
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
                    <span class="form-text" for="status">@lang('label.customers.tr_status') :</span>
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
                    <span class="form-text" for="created_at">@lang('label.customers.tr_created_at') :</span>
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
                <a class="btn btn-primary pull-right" href="/customers/edit/{{ $data['id'] ?? '' }}"><i class="fa fa-edit"></i>
                    &nbsp;@lang('label.edit')</a>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <form method="post" action="/customers/delete/{{ $data['id'] ?? '' }}">
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

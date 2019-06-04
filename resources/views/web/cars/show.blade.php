@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.companies.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.companies.name') : {{ $data->name ?? '' }}</b></h2>
            <a href="/companies/index" class="pull-right btn btn-info">
                <i class="fa fa-list" aria-hidden="true"></i>
                &nbsp;@lang('label.companies.list_companies')</a>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="name">@lang('label.companies.tr_name') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data->name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="address">@lang('label.companies.tr_address') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data->address ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="phone_number">@lang('label.companies.tr_phone_number') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data->phone_number ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="email">@lang('label.companies.tr_email') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data->email ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="status_name">@lang('label.companies.tr_status') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data->status_name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="created_at">@lang('label.companies.tr_created_at') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data->created_at ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-4">
                <a class="btn btn-primary pull-right" href="/companies/edit/{{ $data['id'] ?? '' }}"><i class="fa fa-edit"></i>
                    &nbsp;@lang('label.edit')</a>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <form method="post" action="/companies/delete/{{ $data['id'] ?? '' }}">
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

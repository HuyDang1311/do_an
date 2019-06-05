@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.plans.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.plans.name') : {{ $data->name ?? '' }}</b></h2>
            <a href="/plans/index" class="pull-right btn btn-info">
                <i class="fa fa-list" aria-hidden="true"></i>
                &nbsp;@lang('label.plans.list_plans')</a>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="address_start_id">@lang('label.plans.tr_address_start_id') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span  class="form-text">{{ $data->addressStart->city ?? '' }} - {{ $data->addressStart->name_station ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="address_end_id">@lang('label.plans.tr_address_end_id') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span  class="form-text">{{ $data->addressEnd->city ?? '' }} - {{ $data->addressEnd->name_station ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="time_start">@lang('label.plans.tr_time_start') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->time_start ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="time_end">@lang('label.plans.tr_time_end') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->time_end ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="car_number_plates">@lang('label.plans.tr_car_number_plates') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->car->car_number_plates ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="car_manufacturer">@lang('label.plans.tr_car_manufacturer') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->car->car_manufacturer ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="user_driver_id">@lang('label.plans.tr_user_driver_id') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->driver->name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="user_phone">@lang('label.plans.tr_user_phone') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->driver->phone_number ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="company_name">@lang('label.plans.tr_company_name') :</span>
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
                    <span class="form-text" for="company_phone_number">@lang('label.plans.tr_company_phone_number') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->company->phone_number ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="company_address">@lang('label.plans.tr_company_address') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->company->address ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="price_ticket">@lang('label.plans.tr_price_ticket') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->price_ticket ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="status">@lang('label.plans.tr_status') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">@lang(\App\Models\Plan::$status[$data->status] ?? '')</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="created_at">@lang('label.plans.tr_created_at') :</span>
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
                <a class="btn btn-primary pull-right" href="/plans/edit/{{ $data['id'] ?? '' }}"><i class="fa fa-edit"></i>
                    &nbsp;@lang('label.edit')</a>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <form method="post" action="/plans/delete/{{ $data['id'] ?? '' }}">
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

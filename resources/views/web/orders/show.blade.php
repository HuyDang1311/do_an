@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.orders.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.orders.name') : {{ $data->name ?? '' }}</b></h2>
            <a href="/orders/index" class="pull-right btn btn-info">
                <i class="fa fa-list" aria-hidden="true"></i>
                &nbsp;@lang('label.orders.list_orders')</a>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="customer_name">@lang('label.orders.tr_name') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->customer->name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="customer_address">@lang('label.orders.tr_address') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->customer->address ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="customer_email">@lang('label.orders.tr_email') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->customer->email ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="customer_phone_number">@lang('label.orders.tr_phone_number') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->customer->phone_number ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group pull-right">
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="order_code">@lang('label.orders.tr_order_code') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span  class="form-text">{{ $data->order_code ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="payment_method_id">@lang('label.orders.tr_payment_method_id') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">@lang(\App\Models\Order::$paymentMethodObject[$data->payment_method_id] ?? '')</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="coupon_id">@lang('label.orders.tr_coupon_id') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->coupon_id ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="status">@lang('label.orders.tr_status') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">@lang(\App\Models\Order::$statusObject[$data->status] ?? '')</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="seat_ids">@lang('label.orders.tr_seat_ids') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->seat_ids ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="quantity">@lang('label.orders.tr_quantity') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->orderDetail->quantity ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="total_money">@lang('label.orders.tr_total_money') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->orderDetail->total_money ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="address_start">@lang('label.orders.tr_address_start') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->orderDetail->addressStart->city ?? '' }} - {{ $data->orderDetail->addressStart->name_station ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="address_end">@lang('label.orders.tr_address_end') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->orderDetail->addressEnd->city ?? '' }} - {{ $data->orderDetail->addressEnd->name_station ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="form-group">
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="company_name">@lang('label.orders.tr_company_name') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->company->name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="driver_name">@lang('label.orders.tr_driver_name') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->driver->name ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="driver_phone">@lang('label.orders.tr_driver_phone') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->driver->phone_number ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="car_number_plates">@lang('label.orders.tr_car_number_plates') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->car->car_number_plates ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="car_manufacturer">@lang('label.orders.tr_car_manufacturer') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->car->car_manufacturer ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="price">@lang('label.orders.tr_price') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->price_ticket ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="time_start">@lang('label.orders.tr_time_start') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->time_start ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="time_end">@lang('label.orders.tr_time_end') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span class="form-text">{{ $data->plan->time_end ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span class="form-text" for="created_at">@lang('label.orders.tr_created_at') :</span>
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
        <div class="box-footer with-border"></div>
    </div>
@stop

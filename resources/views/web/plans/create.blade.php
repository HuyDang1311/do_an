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
        <form role="form" method="post">
            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="address_start_id">@lang('label.plans.tr_address_start_id') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="address_start_id" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($busStations as $busStation)
                                <option value="{{ $busStation->id }}">{{ $busStation->city ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="address_end_id">@lang('label.plans.tr_address_end_id') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="address_end_id" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($busStations as $busStation)
                                <option value="{{ $busStation->id }}">{{ $busStation->city ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="time_start">@lang('label.plans.tr_time_start') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="datetime" name="time_start" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="time_end">@lang('label.plans.tr_time_end') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="datetime" name="time_end" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="user_driver_id">@lang('label.plans.tr_user_driver_id') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="user_driver_id" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="car_id">@lang('label.plans.tr_car') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="car_id" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($cars as $car)
                                <option value="{{ $car->id }}">{{ $car->car_number_plates ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="company_id">@lang('label.plans.tr_company_id') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="company_id" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="price_ticket">@lang('label.plans.tr_price_ticket') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="number" name="price_ticket" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="reset" class="btn btn-default pull-right"><i class="fa fa-eraser"></i>
                            &nbsp;@lang('label.reset')</button>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="form-group">
                        @csrf
                        <button type="submit" class="btn btn-success pull-left"><i class="fa fa-edit"></i>
                            &nbsp;@lang('label.create')</button>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <div class="form-group"></div>
        <div class="box-footer with-border"></div>
    </div>
@stop

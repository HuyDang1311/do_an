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
        <form role="form" method="post">
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
                                <option {!! $data->address_start_id === $busStation->id ? 'selected' : '' !!}
                                        value="{{ $busStation->id }}">{{ $busStation->city ?? '' }}</option>
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
                                <option {!! $data->address_end_id === $busStation->id ? 'selected' : '' !!}
                                        value="{{ $busStation->id }}">{{ $busStation->city ?? '' }}</option>
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
                        <input class="form-control" type="datetime" name="time_start" value="{{ $data->time_start ?? '' }}" required />
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
                        <input class="form-control" type="datetime" name="time_end" value="{{ $data->time_end ?? '' }}" required />
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
                                <option {!! $data->user_driver_id === $driver->id ? 'selected' : '' !!}
                                        value="{{ $driver->id }}">{{ $driver->name ?? '' }}</option>
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
                                <option {!! $data->car_id === $car->id ? 'selected' : '' !!}
                                        value="{{ $car->id }}">{{ $car->car_number_plates ?? '' }}</option>
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
                                <option {!! $data->company_id === $company->id ? 'selected' : '' !!}
                                        value="{{ $company->id }}">{{ $company->name ?? '' }}</option>
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
                        <span for="status">@lang('label.plans.tr_status') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="status" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($status as $key => $value)
                                <option {!! $data->status === $key ? 'selected' : '' !!} value="{{ $key }}">{{ $value }}</option>
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
                        <input class="form-control" type="number" name="price_ticket" value="{{ $data->price_ticket ?? '' }}" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.box-header -->
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
                        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-edit"></i>
                            &nbsp;@lang('label.update')</button>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <div class="form-group"></div>
        <div class="box-footer with-border"></div>
    </div>
@stop

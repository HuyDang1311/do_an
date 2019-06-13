@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.cars.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.cars.name') {{ $data->car_number_plates ?? '' }}</b></h2>
            <a href="/cars/index" class="pull-right btn btn-info">
                <i class="fa fa-list" aria-hidden="true"></i>
                &nbsp;@lang('label.cars.list_cars')</a>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 form-title">
                    <div class="form-group pull-right">
                        <span class="form-text" for="cars_number_plates">@lang('label.cars.tr_car_number_plates')</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8 form-value">
                    <div class="form-group">
                        <span  class="form-text">{{ $data->car_number_plates ?? '' }}</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 form-title">
                    <div class="form-group pull-right">
                        <span class="form-text" for="cars_manufacturer">@lang('label.cars.tr_car_manufacturer')</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8 form-value">
                    <div class="form-group">
                        <span class="form-text">{{ $data->car_manufacturer ?? '' }}</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 form-title">
                    <div class="form-group pull-right">
                        <span class="form-text" for="company_id">@lang('label.cars.tr_company_name')</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8 form-value">
                    <div class="form-group">
                        <span class="form-text">{{ $data->company->name ?? '' }}</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 form-title">
                    <div class="form-group pull-right">
                        <span class="form-text" for="type">@lang('label.cars.tr_type')</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8 form-value">
                    <div class="form-group">
                        <span class="form-text">{{ $data->type_name ?? '' }}</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 form-title">
                    <div class="form-group pull-right">
                        <span class="form-text" for="seat_quantity">@lang('label.cars.tr_seat_quantity')</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8 form-value">
                    <div class="form-group">
                        <span class="form-text">{{ $data->seat_quantity ?? '' }}</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 form-title">
                    <div class="form-group pull-right">
                        <span class="form-text" for="created_at">@lang('label.cars.tr_created_at')</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8 form-value">
                    <div class="form-group">
                        <span class="form-text">{{ $data->created_at ?? '' }}</span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <div class="col-md-12 form-group"></div>
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="col-md-4">
                    <a class="btn btn-primary pull-right" href="/cars/edit/{{ $data['id'] ?? '' }}"><i class="fa fa-edit"></i>
                        &nbsp;@lang('label.edit')</a>
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <form method="post" action="/cars/delete/{{ $data['id'] ?? '' }}">
                        @csrf
                        <button type="submit" class="btn btn-danger pull-left"><i class="fa fa-search"></i>
                            &nbsp;@lang('label.delete')</button>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="box-footer with-border"></div>
    </div>
@stop

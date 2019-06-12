@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.cars.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.cars.name') : {{ $data->name ?? '' }}</b></h2>
            <a href="/cars/index" class="pull-right btn btn-info">
                <i class="fa fa-list" aria-hidden="true"></i>
                &nbsp;@lang('label.cars.list_cars')</a>
        </div>
        <div class="form-group">
        </div>
        <form role="form" method="post">
            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="car_number_plates">@lang('label.cars.tr_car_number_plates') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="car_number_plates" required/>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="car_manufacturer">@lang('label.cars.tr_car_manufacturer') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="text" name="car_manufacturer" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="type">@lang('label.cars.tr_type') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="type" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($types as $key => $value)
                                <option value="{{ $key }}">{{ $value ?? '' }}</option>
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
                        <span for="seat_quantity">@lang('label.cars.tr_seat_quantity') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="seat_quantity" class="form-control" required>
                            <option value="">@lang('label.please_select')</option>
                            @foreach($seat as $key => $value)
                                <option value="{{ $key }}">{{ $value ?? '' }}</option>
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

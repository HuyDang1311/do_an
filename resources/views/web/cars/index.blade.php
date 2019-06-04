@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.cars.title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.search')</b></h2>
        </div>
        <!-- /.box-header -->
        <form role="form" method="get">
            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="car_number_plates">@lang('label.cars.car_number_plates')</label>
                            <input type="text" class="form-control" id="car_number_plates" name="car_number_plates"
                                   value="{{ $input['car_number_plates'] ?? '' }}"
                                   placeholder="{{ trans('label.cars.pld_car_number_plates') }}">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="car_manufacturer">@lang('label.cars.car_manufacturer')</label>
                            <input type="text" class="form-control" id="car_manufacturer" name="car_manufacturer"
                                   value="{{ $input['car_manufacturer'] ?? '' }}"
                                   placeholder="{{ trans('label.cars.pld_car_manufacturer') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_id">@lang('label.cars.company_id')</label>
                            <select name="company_id" class="form-control" >
                                <option value="">@lang('label.please_select')</option>
                                @foreach($companies as $company)
                                    <option {!! $company->id === ($input['company_id'] ?? '') ? 'selected' : '' !!} value="{{ $company->id }}">{{ $company->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">@lang('label.cars.type')</label>
                            <select name="type" class="form-control" >
                                <option value="">@lang('label.please_select')</option>
                                @foreach($types as $key => $value)
                                    <option {!! $key === ($input['type'] ?? '') ? 'selected' : '' !!} value="{{ $key }}">{{ $value ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="reset" class="btn btn-default pull-right"><i class="fa fa-eraser"></i>
                                &nbsp;@lang('label.clear')</button>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info pull-left"><i class="fa fa-search"></i>
                                &nbsp;@lang('label.search')</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </form>
    </div>
    <div class="box box-default">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><b>@lang('label.cars.list_cars')</b></h3>
                <a href="/cars/create" class="btn btn-success pull-right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    &nbsp;@lang('label.create')</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="example2" class="table table-bordered table-hover table-striped table-condensed tasks-table" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th>@lang('label.cars.tr_no')</th>
                                        <th>@lang('label.cars.tr_car_number_plates')</th>
                                        <th>@lang('label.cars.tr_car_manufacturer')</th>
                                        <th>@lang('label.cars.tr_company_name')</th>
                                        <th>@lang('label.cars.tr_type')</th>
                                        <th>@lang('label.cars.tr_seat_quantity')</th>
                                        <th>@lang('label.cars.tr_created_at')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data ?? []))
                                        @foreach($data as $row)
                                            <tr role="row" class="odd">
                                                <td>{{ $row->row_number ?? '' }}</td>
                                                <td>{{ $row->car_number_plates ?? '' }}</td>
                                                <td>{{ $row->car_manufacturer ?? '' }}</td>
                                                <td>{{ $row->company->name ?? '' }}</td>
                                                <td>{{ $row->type_name ?? '' }}</td>
                                                <td>{{ $row->seat_quantity ?? '' }}</td>
                                                <td>{{ $row->created_at ?? '' }}</td>
                                                <td class="sorting_1">
                                                    <div class="btn-group">
                                                        <div class="form-group pull-left" style="margin-left: 10px;">
                                                            <a class="btn btn-default" href="/cars/show/{{ $row->id }}">
                                                                <i class="fa fa-search"></i>
                                                                @lang('label.show')</a>
                                                        </div>
                                                        <div class="form-group pull-left" style="margin-left: 10px;">
                                                            <a class="btn btn-info" href="/cars/edit/{{ $row->id }}">
                                                                <i class="fa fa-edit"></i>
                                                                @lang('label.edit')</a>
                                                        </div>
                                                        <form class="pull-left" method="post" action="/cars/delete/{{ $row->id }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger float-left" style="margin-left: 10px;">
                                                                <i class="fa fa-remove"></i>
                                                                &nbsp;@lang('label.delete')</button>
                                                        </form>
                                                        <!-- /.col -->
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr role="row" class="odd">
                                            <td>@lang('message.not_found')</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@stop

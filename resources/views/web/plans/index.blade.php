@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.plans.title')</h1>
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
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_id">@lang('label.plans.tr_company_id')</label>
                            <select name="company_id" class="form-control" >
                                <option value="">@lang('label.please_select')</option>
                                @foreach($companies as $company)
                                    <option {!! $company->id == ($input['company_id'] ?? '') ? 'selected' : '' !!} value="{{ $company->id }}">{{ $company->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_start_id">@lang('label.plans.tr_address_start_id')</label>
                            <select name="address_start_id" class="form-control" >
                                <option value="">@lang('label.please_select')</option>
                                @foreach($busStations as $busStation)
                                    <option {!! $busStation->id == ($input['address_start_id'] ?? '') ? 'selected' : '' !!} value="{{ $busStation->id }}">{{ $busStation->city ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_driver_id">@lang('label.plans.tr_user_driver_id')</label>
                            <select name="user_driver_id" class="form-control" >
                                <option value="">@lang('label.please_select')</option>
                                @foreach($drivers as $driver)
                                    <option {!! $driver->id == ($input['user_driver_id'] ?? '') ? 'selected' : '' !!} value="{{ $driver->id }}">{{ $driver->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_end_id">@lang('label.plans.tr_address_end_id')</label>
                            <select name="address_end_id" class="form-control" >
                                <option value="">@lang('label.please_select')</option>
                                @foreach($busStations as $busStation)
                                    <option {!! $busStation->id == ($input['address_end_id'] ?? '') ? 'selected' : '' !!} value="{{ $busStation->id }}">{{ $busStation->city ?? '' }}</option>
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
                <h3 class="box-title"><b>@lang('label.plans.list_plans')</b></h3>
                <a href="/plans/create" class="btn btn-success pull-right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    &nbsp;@lang('label.create')</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            {{ $data->links() }}
                            <table id="example2" class="table table-bordered table-hover table-striped table-condensed tasks-table" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th>@lang('label.plans.tr_no')</th>
                                        <th>@lang('label.plans.tr_address_start_id')</th>
                                        <th>@lang('label.plans.tr_address_end_id')</th>
                                        <th>@lang('label.plans.tr_time_start')</th>
                                        <th>@lang('label.plans.tr_time_end')</th>
                                        <th>@lang('label.plans.tr_car_number_plates')</th>
                                        <th>@lang('label.plans.tr_car_manufacturer')</th>
                                        <th>@lang('label.plans.tr_user_driver_id')</th>
                                        <th>@lang('label.plans.tr_user_phone')</th>
                                        <th>@lang('label.plans.tr_company_name')</th>
                                        <th>@lang('label.plans.tr_company_phone')</th>
                                        <th>@lang('label.plans.tr_price_ticket')</th>
                                        <th>@lang('label.plans.tr_status')</th>
                                        <th>@lang('label.plans.tr_created_at')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data ?? []))
                                        @foreach($data as $row)
                                            <tr role="row" class="odd">
                                                <td>{{ $row->row_number ?? '' }}</td>
                                                <td>{{ $row->addressStart->city ?? '' }} - {{ $row->addressStart->name_station ?? '' }}</td>
                                                <td>{{ $row->addressEnd->city ?? '' }} - {{ $row->addressEnd->name_station ?? '' }}</td>
                                                <td>{{ $row->time_start ?? '' }}</td>
                                                <td>{{ $row->time_end ?? '' }}</td>
                                                <td>{{ $row->car->car_number_plates ?? '' }}</td>
                                                <td>{{ $row->car->car_manufacturer ?? '' }}</td>
                                                <td>{{ $row->driver->name ?? '' }}</td>
                                                <td>{{ $row->driver->phone_number ?? '' }}</td>
                                                <td>{{ $row->company->name ?? '' }}</td>
                                                <td>{{ $row->company->phone_number ?? '' }}</td>
                                                <td>{{ $row->price_ticket ?? '' }}</td>
                                                <td>@lang(\App\Models\Plan::$status[$row->status] ?? '')</td>
                                                <td>{{ $row->created_at ?? '' }}</td>
                                                <td class="sorting_1">
                                                    <div class="btn-group">
                                                        <div class="form-group pull-left">
                                                            <a class="btn btn-default btn-table-list" href="/plans/show/{{ $row->id }}">
                                                                <i class="fa fa-search"></i>
                                                                @lang('label.show')</a>
                                                        </div>
                                                        <div class="form-group pull-left">
                                                            <a class="btn btn-info btn-table-list" href="/plans/edit/{{ $row->id }}">
                                                                <i class="fa fa-edit"></i>
                                                                @lang('label.edit')</a>
                                                        </div>
                                                        <form class="pull-left" method="post" action="/plans/delete/{{ $row->id }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger float-left btn-table-list">
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

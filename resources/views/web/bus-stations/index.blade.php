@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.bus-stations.title')</h1>
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
                            <label for="city_name">@lang('label.bus-stations.city_name')</label>
                            <input type="text" class="form-control" id="city_name" name="city_name"
                                   value="{{ $input['city_name'] ?? '' }}"
                                   placeholder="{{ trans('label.bus-stations.pld_city_name') }}">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="station_name">@lang('label.bus-stations.station_name')</label>
                            <input type="text" class="form-control" id="station_name" name="station_name"
                                   value="{{ $input['station_name'] ?? '' }}"
                                   placeholder="{{ trans('label.bus-stations.pld_station_name') }}">
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
                            <input type="hidden" id="type" name="type"
                                   value="{{ \App\Models\BusStation::TYPE_BUS_STATION }}">
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
                <h3 class="box-title"><b>@lang('label.bus-stations.list_stations')</b></h3>
                <a href="/bus-stations/create" class="btn btn-success pull-right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    &nbsp;@lang('label.create')</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th>@lang('label.bus-stations.tr_no')</th>
                                        <th>@lang('label.bus-stations.tr_city')</th>
                                        <th>@lang('label.bus-stations.tr_name_station')</th>
                                        <th>@lang('label.bus-stations.tr_created_at')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data)
                                        @foreach($data as $row)
                                            <tr role="row" class="odd">
                                                <td>{{ $row['row_number'] ?? '' }}</td>
                                                <td>{{ $row['city'] ?? '' }}</td>
                                                <td>{{ $row['name_station'] ?? '' }}</td>
                                                <td>{{ $row['created_at'] ?? '' }}</td>
                                                <td class="sorting_1">
                                                    <div class="btn-group">
                                                        <div class="form-group pull-left">
                                                            <a class="btn btn-default btn-table-list" href="/bus-stations/show/{{ $row['id'] }}">
                                                                <i class="fa fa-search"></i>
                                                                @lang('label.show')</a>
                                                        </div>
                                                        <div class="form-group pull-left">
                                                            <a class="btn btn-info btn-table-list" href="/bus-stations/edit/{{ $row['id'] }}">
                                                                <i class="fa fa-edit"></i>
                                                                @lang('label.edit')</a>
                                                        </div>
                                                        <form class="pull-left" method="post" action="/bus-stations/delete/{{ $row['id'] }}">
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
                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-sm-5">--}}
                    {{--                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1--}}
                    {{--                                to 10 of 57--}}
                    {{--                                entries--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-sm-7">--}}
                    {{--                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">--}}
                    {{--                                <ul class="pagination">--}}
                    {{--                                    <li class="paginate_button previous disabled" id="example2_previous"><a href="#"--}}
                    {{--                                                                                                            aria-controls="example2"--}}
                    {{--                                                                                                            data-dt-idx="0"--}}
                    {{--                                                                                                            tabindex="0">Previous</a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="paginate_button active"><a href="#" aria-controls="example2"--}}
                    {{--                                                                          data-dt-idx="1"--}}
                    {{--                                                                          tabindex="0">1</a></li>--}}
                    {{--                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2"--}}
                    {{--                                                                    tabindex="0">2</a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3"--}}
                    {{--                                                                    tabindex="0">3</a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4"--}}
                    {{--                                                                    tabindex="0">4</a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5"--}}
                    {{--                                                                    tabindex="0">5</a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6"--}}
                    {{--                                                                    tabindex="0">6</a>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="paginate_button next" id="example2_next"><a href="#"--}}
                    {{--                                                                                           aria-controls="example2"--}}
                    {{--                                                                                           data-dt-idx="7"--}}
                    {{--                                                                                           tabindex="0">Next</a></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@stop

@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.orders.title')</h1>
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
                            <label for="name">@lang('label.orders.tr_name')</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $input['name'] ?? '' }}"
                                   placeholder="{{ trans('label.orders.pld_name') }}">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">@lang('label.orders.tr_email')</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   value="{{ $input['email'] ?? '' }}"
                                   placeholder="{{ trans('label.orders.pld_email') }}">
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
                <h3 class="box-title"><b>@lang('label.orders.list_orders')</b></h3>
                <a href="/orders/create" class="btn btn-success pull-right">
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
                                        <th>@lang('label.orders.tr_no')</th>
                                        <th>@lang('label.orders.tr_customer_name')</th>
                                        <th>@lang('label.orders.tr_start_bus_station')</th>
                                        <th>@lang('label.orders.tr_start_time')</th>
                                        <th>@lang('label.orders.tr_end_bus_station')</th>
                                        <th>@lang('label.orders.tr_time_end')</th>
                                        <th>@lang('label.orders.tr_company_id')</th>
                                        <th>@lang('label.orders.tr_status')</th>
                                        <th>@lang('label.orders.tr_created_at')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data->items() ?? []))
                                        @foreach($data->items() as $row)
{{--                                            <tr role="row" class="odd">--}}
{{--                                                <td>{{ $row->row_number ?? '' }}</td>--}}
{{--                                                <td>{{ $row->name ?? '' }}</td>--}}
{{--                                                <td>{{ $row->email ?? '' }}</td>--}}
{{--                                                <td>{{ $row->username ?? '' }}</td>--}}
{{--                                                <td>{{ $row->address ?? '' }}</td>--}}
{{--                                                <td>{{ $row->phone_number ?? '' }}</td>--}}
{{--                                                <td>{{ $row->company->name ?? '' }}</td>--}}
{{--                                                <td>{{ $row->status_name ?? '' }}</td>--}}
{{--                                                <td>{{ $row->created_at ?? '' }}</td>--}}
{{--                                                <td class="sorting_1">--}}
{{--                                                    <div class="btn-group">--}}
{{--                                                        <div class="form-group pull-left">--}}
{{--                                                            <a class="btn btn-default btn-table-list" href="/orders/show/{{ $row->id }}">--}}
{{--                                                                <i class="fa fa-search"></i>--}}
{{--                                                                @lang('label.show')</a>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group pull-left">--}}
{{--                                                            <a class="btn btn-info btn-table-list" href="/orders/edit/{{ $row->id }}">--}}
{{--                                                                <i class="fa fa-edit"></i>--}}
{{--                                                                @lang('label.edit')</a>--}}
{{--                                                        </div>--}}
{{--                                                        <form class="pull-left" method="post" action="/orders/delete/{{ $row->id }}">--}}
{{--                                                            @csrf--}}
{{--                                                            <button type="submit" class="btn btn-danger float-left btn-table-list">--}}
{{--                                                                <i class="fa fa-remove"></i>--}}
{{--                                                                &nbsp;@lang('label.delete')</button>--}}
{{--                                                        </form>--}}
{{--                                                        <!-- /.col -->--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
                                        @endforeach
                                    @else
                                        <tr role="row" class="odd">
                                            <td>@lang('message.not_found')</td>
                                        </tr>
                                    @endif
                                </tbody>
                                {{ $data->links() }}
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

@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.companies.title')</h1>
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
                            <label for="name">@lang('label.companies.name')</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $input['name'] ?? '' }}"
                                   placeholder="{{ trans('label.companies.pld_name') }}">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">@lang('label.companies.address')</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ $input['address'] ?? '' }}"
                                   placeholder="{{ trans('label.companies.pld_address') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">@lang('label.companies.phone_number')</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                   value="{{ $input['phone_number'] ?? '' }}"
                                   placeholder="{{ trans('label.companies.pld_phone_number') }}">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">@lang('label.companies.email')</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   value="{{ $input['email'] ?? '' }}"
                                   placeholder="{{ trans('label.companies.pld_email') }}">
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
                <h3 class="box-title"><b>@lang('label.companies.list_companies')</b></h3>
                <a href="/companies/create" class="btn btn-success pull-right">
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
                                        <th>@lang('label.companies.tr_no')</th>
                                        <th>@lang('label.companies.tr_name')</th>
                                        <th>@lang('label.companies.tr_address')</th>
                                        <th>@lang('label.companies.tr_phone_number')</th>
                                        <th>@lang('label.companies.tr_email')</th>
                                        <th>@lang('label.companies.tr_status')</th>
                                        <th>@lang('label.companies.tr_created_at')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data ?? []))
                                        @foreach($data as $row)
                                            <tr role="row" class="odd">
                                                <td>{{ $row->row_number ?? '' }}</td>
                                                <td>{{ $row->name ?? '' }}</td>
                                                <td>{{ $row->address ?? '' }}</td>
                                                <td>{{ $row->phone_number ?? '' }}</td>
                                                <td>{{ $row->email ?? '' }}</td>
                                                <td>{{ $row->status_name ?? '' }}</td>
                                                <td>{{ $row->created_at ?? '' }}</td>
                                                <td class="sorting_1">
                                                    <div class="btn-group">
                                                        <div class="form-group pull-left" style="margin-left: 10px;">
                                                            <a class="btn btn-default" href="/companies/show/{{ $row->id }}">
                                                                <i class="fa fa-search"></i>
                                                                @lang('label.show')</a>
                                                        </div>
                                                        <div class="form-group pull-left" style="margin-left: 10px;">
                                                            <a class="btn btn-info" href="/companies/edit/{{ $row->id }}">
                                                                <i class="fa fa-edit"></i>
                                                                @lang('label.edit')</a>
                                                        </div>
                                                        <form class="pull-left" method="post" action="/companies/delete/{{ $row->id }}">
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

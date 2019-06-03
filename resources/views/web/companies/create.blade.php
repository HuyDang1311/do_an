@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.companies.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.companies.name') : {{ $data->name ?? '' }}</b></h2>
            <a href="/companies/index" class="pull-right btn btn-info">@lang('label.companies.list_companies')</a>
        </div>
        <div class="form-group">
        </div>
        <form role="form" method="post">
            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="name">@lang('label.companies.tr_name') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="address">@lang('label.companies.tr_address') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="text" name="address" />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="phone_number">@lang('label.companies.tr_phone_number') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="text" name="phone_number" />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="email">@lang('label.companies.tr_email') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="form-group pull-right">--}}
{{--                        <span for="status">@lang('label.companies.tr_status') :</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="form-group">--}}
{{--                        <select name="status" class="form-control">--}}
{{--                            @foreach($status_object as $value => $label)--}}
{{--                                <option value="{{ $value }}">{{ $label ?? '' }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--            </div>--}}
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
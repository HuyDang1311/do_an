@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.bus-stations.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.bus-stations.name') : {{ $data['name_station'] ?? '' }}</b></h2>
            <a href="/bus-stations/index" class="pull-right btn btn-info">@lang('label.bus-stations.list_stations')</a>
        </div>
        <div class="form-group">
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="city">@lang('validation.attributes.city') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data['city'] ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="name_station">@lang('validation.attributes.name_station') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data['name_station'] ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="created_at">@lang('validation.attributes.created_at') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data['created_at'] ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="created_at">@lang('validation.attributes.latitude') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data['latitude'] ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pull-right">
                    <span for="created_at">@lang('validation.attributes.longitude') :</span>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="form-group">
                    <span>{{ $data['longitude'] ?? '' }}</span>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-4">
                <a class="btn btn-primary pull-right" href="/bus-stations/edit/{{ $data['id'] ?? '' }}"><i class="fa fa-edit"></i>
                    &nbsp;@lang('label.edit')</a>
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <form method="post" action="/bus-stations/delete/{{ $data['id'] ?? '' }}">
                    @csrf
                    <button type="submit" class="btn btn-danger pull-left"><i class="fa fa-search"></i>
                        &nbsp;@lang('label.delete')</button>
                </form>
            </div>
            <!-- /.col -->
        </div>
        <div class="box-footer with-border"></div>
    </div>
@stop
@extends('adminlte::page')

@section('title', trans('label.title'))

@section('content_header')
    <h1>@lang('label.users.show_title')</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="box-title"><b>@lang('label.users.name') : {{ $data->name ?? '' }}</b></h2>
        </div>
        <div class="form-group">
        </div>
        <form role="form" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="name">@lang('label.users.tr_name') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="name" class="form-control" type="text" name="name" value="{{ $data->name ?? '' }}" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="email">@lang('label.users.tr_email') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="email" class="form-control" type="text" name="email" value="{{ $data->email ?? '' }}" />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="address">@lang('label.users.tr_address') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="address" class="form-control" type="text" name="address" value="{{ $data->address ?? '' }}" required/>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="phone_number">@lang('label.users.tr_phone_number') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="phone_number" class="form-control" type="text" name="phone_number" value="{{ $data->phone_number ?? '' }}" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="username">@lang('label.users.tr_username') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="username" class="form-control" type="text" name="username" value="{{ $data->username ?? '' }}" required />
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group pull-right">
                        <span for="password">@lang('label.users.tr_password') :</span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input id="password" class="form-control" type="password" name="password" />
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

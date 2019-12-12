@extends('layouts.master')

@section('content-header')
    <h6>{{_ths('New Role')}}</h6>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ _ths('home') }}</a></li>
        <li class=""><a href="{{ route('admin.user.role.index') }}">{{ _ths('roles') }}</a></li>
        <li class="active">{{ _ths('new') }}</li>
    </ol>
@stop

@section('content')
{!! Form::open(['route' => 'admin.user.role.store', 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">{{ _ths('data') }}</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab">{{ _ths('permissions') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', _ths('name')) !!}
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => _ths('name')]) !!}
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                    {!! Form::label('slug', _ths('slug')) !!}
                                    {!! Form::text('slug', old('slug'), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => _ths('slug')]) !!}
                                    {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2-2">
                    @include('user::admin.partials.permissions-create')
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ _ths('create') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.user.role.index')}}"><i class="fa fa-times"></i> {{ _ths('cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ _ths('back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
<script>
$( document ).ready(function() {
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
    $(document).keypressAction({
        actions: [
            { key: 'b', route: "<?= route('admin.user.role.index') ?>" }
        ]
    });
});
</script>
@endpush

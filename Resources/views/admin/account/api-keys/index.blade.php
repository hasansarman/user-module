@extends('layouts.master')

@section('content-header')
    <h6>
        {{ _ths('api-keys') }}
    </h6>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ _ths('home') }}</a></li>
        <li class="active">{{ _ths('api-keys') }}</li>
    </ol>

@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.account.api.create') }}" class="btn btn-primary btn-flat">
                        <i class="fa fa-plus"></i> {{ _ths('generate new api key') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ _ths('your api keys') }}</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-4">
                        <?php if ($tokens->isEmpty() === false): ?>
                            <ul class="list-unstyled">
                                <?php foreach ($tokens as $token): ?>
                                    <li style="margin-bottom: 20px;">
                                        {!! Form::open(['route' => ['admin.account.api.destroy', $token->id], 'method' => 'delete', 'class' => '']) !!}
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-danger btn-flat" onclick="return confirm('{{ trans('user::users.delete api key confirm') }}')">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                            <input type="text" class="form-control api-key" readonly value="{{ $token->access_token }}" >
                                            <span class="input-group-btn">
                                                <a href="#" class="btn btn-default btn-flat jsClipboardButton">
                                                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                                                </a>
                                            </span>
                                        </div>
                                        {!! Form::close() !!}
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>{{ _ths('you have no api keys') }} <a href="{{ trans('admin.account.api.create') }}">{{ _ths('generate one') }}</a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col (MAIN) -->
    </div>

    @include('core::partials.delete-modal')
@stop

@push('js-stack')
    <script>
        new Clipboard('.jsClipboardButton', {
            target: function(trigger) {
                return $(trigger).parent().parent().find('.api-key')[0];
            }
        });
    </script>
@endpush

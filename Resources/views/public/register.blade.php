@extends('layouts.account')
@section('title')
    {{ _ths('register') }} | @parent
@stop

@section('content')
    <div class="register-logo">
        <a href="{{ url('/') }}">{{ setting('core::site-name') }}</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">{{ _ths('register') }}</p>
        @include('partials.notifications')
        {!! Form::open(['route' => 'register.post']) !!}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                <input type="email" name="email" class="form-control" autofocus
                       placeholder="{{ _ths('email') }}" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="{{ _ths('password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error has-feedback' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ _ths('password confirmation') }}">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
            </div>
            @if(View::exists('profile::admin.partials.register-fields'))
                @include('profile::admin.partials.register-fields')
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ _ths('register me') }}</button>
                </div>
            </div>
        {!! Form::close() !!}

        <div class="social-auth-links text-center">
          
        </div>

        <div class="row">
            <div class="col-xs-12">
                <a href="{{ route('login') }}" class="text-center">{{ _ths('I already have a membership') }}</a>
            </div>
        </div>

    </div>
@stop

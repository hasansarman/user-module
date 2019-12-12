@extends('layouts.account')

@section('title')
    {{ _ths('login') }} | @parent
@stop

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ setting('core::site-name') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ _ths('welcome') }}</p>
        @include('partials.notifications')

        {!! Form::open(['route' => 'login.post']) !!}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" autofocus
                       name="email" placeholder="{{ _ths('email') }}" value="{{ old('email')}}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control"
                       name="password" placeholder="{{ _ths('password') }}" value="{{ old('password')}}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember_me"> {{ _ths('remember me') }}
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ _ths('login') }}
                    </button>
                </div>
            </div>
        </form>

        <a href="{{ route('reset')}}">{{ _ths('forgot password') }}</a><br>
        @if (config('asgard.user.config.allow_user_registration'))
            <a href="{{ route('register')}}" class="text-center">{{ _ths('register')}}</a>
        @endif
    </div>
@stop

@extends('layouts.master')

@section('content-header')
<h6>
    {{ _ths('edit user') }} <small>{{ $user->present()->fullname() }}</small>
</h6>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ _ths('home') }}</a></li>
    <li class=""><a href="{{ route('admin.user.user.index') }}">{{ _ths('users') }}</a></li>
    <li class="active">{{ _ths('edit user') }}</li>
</ol>
@stop

@section('content')
{!! Form::open(['route' => ['admin.user.user.update', $user->id], 'method' => 'put']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">{{ _ths('data') }}</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab">{{ _ths('roles') }}</a></li>
                <li class=""><a href="#tab_3-3" data-toggle="tab">{{ _ths('permissions') }}</a></li>
                <li class=""><a href="#password_tab" data-toggle="tab">{{ _ths('new password') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    {!! Form::label('first_name', _ths('firstname')) !!}
                                    {!! Form::text('first_name', old('first_name', $user->first_name), ['class' => 'form-control', 'placeholder' => _ths('firstname')]) !!}
                                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    {!! Form::label('last_name', _ths('user::users.form.last-name')) !!}
                                    {!! Form::text('last_name', old('last_name', $user->last_name), ['class' => 'form-control', 'placeholder' => _ths('lastname')]) !!}
                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    {!! Form::label('email', _ths('email')) !!}
                                    {!! Form::email('email', old('email', $user->email), ['class' => 'form-control', 'placeholder' => _ths('email')]) !!}
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="checkbox{{ $errors->has('activated') ? ' has-error' : '' }}">
                                    <input type="hidden" value="{{ $user->id === $currentUser->id ? '1' : '0' }}" name="activated"/>
                                    <?php $oldValue = (bool) $user->isActivated() ? 'checked' : ''; ?>
                                    <label for="activated">
                                        <input id="activated"
                                               name="activated"
                                               type="checkbox"
                                               class="flat-blue"
                                               {{ $user->id === $currentUser->id ? 'disabled' : '' }}
                                               {{ old('activated', $oldValue) }}
                                               value="1" />
                                        {{ _ths('is activated') }}
                                        {!! $errors->first('activated', '<span class="help-block">:message</span>') !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ _ths('roles') }}</label>
                                <select multiple="" class="form-control" name="roles[]">
                                    <?php foreach ($roles as $role): ?>
                                        <option value="{{ $role->id }}" <?php echo $user->hasRoleId($role->id) ? 'selected' : '' ?>>{{ $role->name }}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3-3">
                    @include('user::admin.partials.permissions', ['model' => $user])
                </div>
                <div class="tab-pane" id="password_tab">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{ _ths('new password setup') }}</h4>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    {!! Form::label('password', _ths('new password')) !!}
                                    {!! Form::input('password', 'password', '', ['class' => 'form-control']) !!}
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    {!! Form::label('password_confirmation', _ths('new password confirmation')) !!}
                                    {!! Form::input('password', 'password_confirmation', '', ['class' => 'form-control']) !!}
                                    {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>{{ _ths('send reset password mail') }}</h4>
                                <a href="{{ route("admin.user.user.sendResetPassword", $user->id) }}" class="btn btn-flat bg-maroon">
                                    {{ _ths('send reset password email') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat" name="button" value="index">
                        <i class="fa fa-angle-left"></i>
                        {{ _ths('update and back') }}
                    </button>
                    <button type="submit" class="btn btn-primary btn-flat">{{ _ths('update') }}</button>
                    <button type="reset" class="btn btn-default btn-flat" name="button">{{ _ths('reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.user.user.index')}}"><i class="fa fa-times"></i> {{ _ths('cancel') }}</a>
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
    $('[data-toggle="tooltip"]').tooltip();
    $(document).keypressAction({
        actions: [
            { key: 'b', route: "<?= route('admin.user.role.index') ?>" }
        ]
    });
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>
@endpush

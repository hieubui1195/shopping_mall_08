@extends('auth.layout')

@section('content')
    <h2 class="text-center">@lang('custom.common.login')</h2>
    
    {!! Form::open(['class' => 'login-form']) !!}

        <div class="form-group">
            {!! Form::label(
                'email',
                Lang::get('custom.common.email'),
                [
                    'class' => 'text-uppercase',
                ]
            ) !!}
            {!! Form::email(
                'email',
                null,
                [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => Lang::get('custom.common.email'),
                ]
            ) !!}
            @if($errors->first('email'))
                <p class="text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </p>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label(
                'password',
                Lang::get('custom.common.password'),
                [
                    'class' => 'text-uppercase',
                ]
            ) !!}
            {!! Form::password(
                'password',
                [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => Lang::get('custom.common.password'),
                ]
            ) !!}
            @if($errors->first('password'))
                <p class="text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </p>
            @endif
        </div>

        <div class="form-check">
            {!! Form::checkbox('remember', old('remember') ? true : false ) !!}
            {!! Form::label(Lang::get('custom.admin_login.remember_me')) !!}
        </div>

        <div class="form-group">
            {!! Form::submit(
                Lang::get('custom.common.login'),
                [
                    'class' => 'btn btn-login'
                ]
            ) !!}
            
            {!! Html::linkRoute(
                'register',
                Lang::get('custom.common.register'),
                [],
                [
                    'class' => 'btn btn-primary',
                ]
            ) !!}
        </div>

        <div class="form-group">
            {!! Html::linkRoute('password.request', Lang::get('custom.admin_login.forgot_password')) !!}
        </div>

    {!! Form::close() !!}

@endsection

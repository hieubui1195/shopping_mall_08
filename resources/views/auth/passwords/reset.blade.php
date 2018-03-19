@extends('auth.layout')

@section('content')
    <h2 class="text-center">@lang('custom.common.reset_password')</h2>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::open([
        'class' => 'login-form',
        'route' => 'password.request',
    ]) !!}
        
        {!! Form::hidden('token', $token) !!}

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
                old('email'),
                [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => Lang::get('custom.common.email'),
                ]
            ) !!}
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
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
            @if ($errors->has('password'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label(
                'password',
                Lang::get('custom.common.re_pass'),
                [
                    'class' => 'text-uppercase',
                ]
            ) !!}
            {!! Form::password(
                'password_confirmation',
                [
                    'id' => 'password-confirmation',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => Lang::get('custom.common.re_pass'),
                ]
            ) !!}
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::submit(
                Lang::get('custom.common.reset_password'),
                [
                    'class' => 'btn btn-primary',
                ]
            ) !!}
        </div>

    {!! Form::close() !!}
@endsection

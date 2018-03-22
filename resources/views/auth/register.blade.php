@extends('auth.layout')

@section('content')
    <h2 class="text-center">@lang('custom.common.register')</h2>

    {!! Form::open([
        'class' => 'login-form',
        'route' => 'register',
    ]) !!}

        <div class="form-group">
            {!! Form::label(
                'name',
                Lang::get('custom.common.name'),
                [
                    'class' => 'text-uppercase',
                ]
            ) !!}
            {!! Form::text(
                'name',
                old('name'),
                [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => Lang::get('custom.common.name'),
                ]
            ) !!}
            @if ($errors->has('name'))
                <span class="text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

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
        </div>

        <div class="form-group">
            {!! Form::submit(Lang::get('custom.common.register'), [ 'class' => 'btn btn-login' ]) !!}

            {!! Html::linkRoute(
                'login',
                Lang::get('custom.common.login'),
                [],
                [
                    'class' => 'btn btn-primary',
                ]
            ) !!}
        </div>

    {!! Form::close() !!}
    
@endsection

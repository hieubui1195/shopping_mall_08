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
        'route' => 'password.email',
    ]) !!}

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
            {!! Form::submit(
                Lang::get('custom.common.send_email'),
                [
                    'class' => 'btn btn-primary'
                ]
            ) !!}

            {!! Html::linkRoute(
                'register',
                Lang::get('custom.common.register'),
                [],
                [
                    'class' => 'btn btn-success',
                ]
            ) !!}

            {!! Html::linkRoute(
                'login',
                Lang::get('custom.common.login'),
                [],
                [
                    'class' => 'btn btn-login',
                ]
            ) !!}
        </div>

    {!! Form::close() !!}
@endsection

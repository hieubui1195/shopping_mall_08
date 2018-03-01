@if (Session::has('msg'))
    <div class="alert alert-success alert-dismissible alert-blink col-sm-3">
        {!! Form::button(
            '&times;',
            [
                'class' => 'close',
                'data-dismiss' => 'alert',
            ]
        ) !!}
        {!! Session::get('msg') !!}
    </div>
@endif

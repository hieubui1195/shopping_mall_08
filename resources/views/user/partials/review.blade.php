@foreach ($reviewLimits as $review)
    <div class="single-review" data-id="{{ $review->id }}">
        <div class="review-heading">
            <div><i class="fa fa-user-o"></i> {{ $review['user']->name }}</a></div>
            <div><i class="fa fa-clock-o"></i> {{ $review->created_at->diffForHumans() }}</a></div>
            <div class="review-rating pull-right">
                @for ($i = 0; $i < $review->rate; $i++)
                    @if ($i < $review->rate)
                        <i class="fa fa-star" style="color: #FFB656;"></i>
                    @endif
                @endfor
                @for ($i = $review->rate; $i < 5; $i++)
                    <i class="fa fa-star-o empty"></i>
                @endfor
                @auth
                    @if (Auth::user()->id == $review->user_id)
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="fa fa-ellipsis-h"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>                         
                                    {!! Html::linkRoute(
                                        'edit-review',
                                        Lang::get('custom.common.edit'),
                                        null,
                                        [
                                            'class' => 'edit-review',
                                            'data-id' => $review->id,
                                        ]
                                    ) !!}
                                </li>
                                <li>
                                    {!! Html::linkRoute(
                                        'delete-review',
                                        Lang::get('custom.common.delete'),
                                        [
                                            'id' => $review->id
                                        ],
                                        [
                                            'class' => 'delete-review',
                                            'data-id' => $review->id,
                                        ]
                                    ) !!}
                                </li>
                            </ul>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
        <div class="review-body">
            <strong>{{ $review->title }}</strong>
            <p>{{ $review->content }}</p>
        </div>
    </div>
@endforeach
<div id="remove-row">
    {!! Form::button(
        Lang::get('custom.common.load'),
        [
            'id' => 'btn-more',
            'data-id' => $review->id,
            'class' => 'btn-block',
        ]
    ) !!}
</div>

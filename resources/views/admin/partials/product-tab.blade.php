<div class="product-tab">
    <ul class="tab-nav">
        <li class="active">
            {{Html::link('#tab1',Lang::get('custom.common.details'),['data-toggle' => 'tab'])}}
        </li>
        <li>
            {{Html::link('#tab2',Lang::get('custom.common.review'),['data-toggle' => 'tab'])}}
        </li>
    </ul>
    <div class="tab-content" style="overflow: auto;">
        <div id="tab1" class="tab-pane fade in active">
            <h4>
                @lang('custom.common.description')
            </h4>
            <p>{{ $product->description }}</p>
            <h4>
                @lang('custom.common.qty')
            </h4>
            <p>{{ $product->amount }}</p>
        </div>
        <div id="tab2" class="tab-pane fade in">
            <div class="box-footer box-comments">
                @foreach ($reviews as $review)
                    {{-- {{ $review['user']->image['image'] }} --}}
                    <div class="box-comment">
                        {!! Html::image(
                            $review['user']->image['image'],
                            'User Image',
                            [
                                'class' => 'img-circle img-sm',
                            ]
                        ) !!}

                        <div class="comment-text">
                            <span class="username">
                                {{ $review['user']->name }} 
                                <i>{{ $review->title }}</i>
                                @for ($i = 0; $i < $review->rate; $i++)
                                    @if ($i < $review->rate)
                                        <i class="fa fa-star" style="color: #FFB656;"></i>
                                    @endif
                                @endfor
                                @for ($i = $review->rate; $i < 5; $i++)
                                    <i class="fa fa-star-o empty"></i>
                                @endfor
                                <span class="text-muted pull-right">
                                    {{ $review->created_at->diffForHumans() }}
                                </span>
                            </span>
                            {{ $review->content }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

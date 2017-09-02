@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{$skip + $take}}" name="skip" id="skip-post" class="skip-post-val">
<input type="hidden" value="{{$take}}" name="take" id="take-post" class="take-post-val">

@foreach($posts as $post)

    <div class="col s12">
        <div class="card-panel" id="zone-post-{{$post->id}}" >
            @include('pages.posts.onePost')
        </div>
    </div>

@endforeach


@if(count($posts) == 0 && $skip == 0)
    <div class="col s12">
        <div class="card-panel">
            <p class="text-center grey-text">
                @lang('pages/post/post.noActuality')<br>
                <a {!! $Helpers::tooltip(trans('pages/post/post.addActuality')) !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$postable_id, "postable_type"=>$postable_type, "post_id"=>"", "title"=>trans('pages/post/post.postActuality'), "method"=>"POST" ]) !!} class="tooltipped btnModal text-cursor">@lang('pages/post/post.postActuality')</a>
            </p>
        </div>
    </div>
@endif

@if(count($posts) < $take)
    <div class="col s12 information-fin-post">
        <p class="text-center grey-text text-bold">
            @lang('pages/post/post.postEnd')
        </p>
    </div>
@endif
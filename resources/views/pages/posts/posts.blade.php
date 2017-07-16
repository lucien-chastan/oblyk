@inject('Helpers','App\Lib\HelpersTemplates')


@foreach($posts as $post)

    <div class="col s12">
        <div class="card-panel" id="zone-post-{{$post->id}}" >
            @include('pages.posts.onePost')
        </div>
    </div>

@endforeach


@if(count($posts) == 0)
    <div class="col s12">
        <div class="card-panel">
            <p class="text-center grey-text">
                Il n'y a pas encore d'acutalité postée ici<br>
                <a {!! $Helpers::tooltip('Poster dans le fil d\'actualité') !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$postable_id, "postable_type"=>$postable_type, "post_id"=>"", "title"=>"Poster une actualité", "method"=>"POST" ]) !!} class="tooltipped btnModal text-cursor">poster une actualité</a>
            </p>
        </div>
    </div>
@endif
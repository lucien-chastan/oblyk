@inject('Helpers','App\Lib\HelpersTemplates')

<div class="blue-border-zone">

    @foreach($posts as $post)

        <div class="blue-border-div" id="zone-post-{{$post->id}}">

            @include('pages.posts.onePost')

        </div>

    @endforeach

</div>

@if(count($posts) == 0)
    <p class="text-center grey-text">
        Il n'y a pas encore d'acutalité postée ici<br>
        <a {!! $Helpers::tooltip('Poster dans le fil d\'actualité') !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$postable_id, "postable_type"=>$postable_type, "post_id"=>"", "title"=>"Poster une actualité", "method"=>"POST" ]) !!} class="tooltipped btnModal text-cursor">poster une actualité</a>
    </p>
@endif
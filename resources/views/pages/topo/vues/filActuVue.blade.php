@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{$topo->id}}" id="id-topo-actualite">

<div class="row">

    <div id="insert-posts-zone">

    </div>

</div>

{{--BOUTON POUR AJOUTER UN POST AU FIL D'ACTUALITÉ--}}
@if(Auth::check())
    <div class="fixed-action-btn horizontal">
        <a {!! $Helpers::tooltip('Poster dans le fil d\'actualité') !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$topo->id, "postable_type"=>"Topo", "post_id"=>"", "title"=>"Poster une actualité", "method"=>"POST" ]) !!} class="btn-floating btn-large red waves-effect waves-light tooltipped btnModal">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endif
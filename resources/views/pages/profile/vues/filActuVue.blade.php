@inject('Helpers','App\Lib\HelpersTemplates')

<input type="hidden" value="{{$user->id}}" id="id-user-actualite">

<div class="row">

    <div id="insert-posts-zone">

    </div>

    <div id="btn-see-more-post" class="text-center text-bold btn-see-more-post">
        <div id="btn-a-see-more-post">
            <a class="btn-flat grey-text" onclick="showLoadedMorePost(true);getMyActuality()">
                <i class="material-icons left">vertical_align_bottom</i>
                Voir les posts plus anciens
            </a>
        </div>
        <div id="div-loader-more-post" class="div-loader-more-post">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{--BOUTON POUR AJOUTER UN POST AU FIL D'ACTUALITÉ--}}
@if(Auth::check())
    <div class="fixed-action-btn horizontal">
        <a {!! $Helpers::tooltip('Poster dans le fil d\'actualité') !!} {!! $Helpers::modal(route('postModal'), ["postable_id"=>$user->id, "postable_type"=>"User", "post_id"=>"", "title"=>"Poster une actualité", "method"=>"POST" ]) !!} class="btn-floating btn-large red waves-effect waves-light tooltipped btnModal">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endif
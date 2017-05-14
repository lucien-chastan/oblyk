@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">

        <div class="card-panel blue-border-zone">

            @foreach($crag->links as $link)
                <div class="blue-border-div">
                    <h6>{{$link->label}}</h6>
                    <a target="_blank" href="{{$link->link}}">{{$link->link}}</a>
                    <div class="markdownZone">{{ $link->description }}</div>
                    <p class="info-user grey-text">
                        ajouté par {{$link->user->name}} le {{$link->created_at->format('d M Y')}}

                        @if(Auth::check())
                            <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$link->id, "model"=>"Link"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                            @if($link->user_id == Auth::id())
                                <i {!! $Helpers::tooltip('Modifier ce lien') !!} {!! $Helpers::modal(route('linkModal'), ["crag_id"=>$crag->id, "link_id"=>$link->id, "title"=>"Modifier le lien", "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                <i {!! $Helpers::tooltip('Supprimer ce lien') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/links/" . $link->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach

            {{--BOUTON POUR AJOUTER UN LIEN--}}
            @if(Auth::check())
                <div class="text-right">
                    <a {!! $Helpers::tooltip('Ajouter un lien') !!} {!! $Helpers::modal(route('linkModal'), ["crag_id"=>$crag->id, "link_id"=>"", "title"=>"Ajouter un lien", "method"=>"POST" ]) !!} id="description-btn-modal" class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
                </div>
            @endif
        </div>
    </div>
</div>
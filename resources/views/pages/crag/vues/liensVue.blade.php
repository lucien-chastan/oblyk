<div class="row">
    <div class="col s12">

        <div class="card-panel links-zone">

            @foreach($crag->links as $link)
                <div class="link-div">
                    <h6>{{$link->label}}</h6>
                    <a target="_blank" href="{{$link->link}}">{{$link->link}}</a>
                    <div class="markdownZone">{{ $link->description }}</div>
                    <p class="info-user-link grey-text">
                        ajouté par {{$link->user->name}} le {{$link->created_at->format('d M Y')}}

                        @if(Auth::check())
                            <i data-modal="{'id':{{$link->id}}, 'model':'Link'}" data-route="{{route('problemModal')}}" data-target="modal" class="material-icons tiny-btn right tooltipped btnModal" data-position="top" data-delay="50" data-tooltip="Signaler un problème">flag</i>
                            @if($link->user_id == Auth::id())
                                <i data-modal="{'crag_id':{{$crag->id}}, 'link_id':{{$link->id}}, 'title':'Modifier le lien', 'method' : 'PUT'}" data-route="{{route('linkModal')}}" data-target="modal" class="material-icons tiny-btn right tooltipped btnModal" data-position="top" data-delay="50" data-tooltip="Modifier cette déscription">edit</i>
                                <i data-modal="{'route' : '/links/{{$link->id}}'}" data-route="{{route('deleteModal')}}" data-target="modal" class="material-icons tiny-btn right tooltipped btnModal" data-position="top" data-delay="50" data-tooltip="Supprimer cette déscription">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach

            {{--BOUTON POUR AJOUTER UN LIEN--}}
            @if(Auth::check())
                <div class="text-right">
                    <a data-modal="{'crag_id':{{$crag->id}}, 'link_id':'', 'title':'Ajouter un lien', 'method' : 'POST'}" data-route="{{route('linkModal')}}" data-target="modal" id="description-btn-modal" data-position="top" data-delay="50" data-tooltip="Ajouter un lien"  class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
                </div>
            @endif
        </div>
    </div>
</div>
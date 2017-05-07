<div class="col s12">
    <div class="card-panel">
        <h2 class="loved-king-font">Déscription par ce qui y grimpe</h2>

        <div class="description-zone">
            @foreach ($crag->descriptions as $description)
                <div class="description-div">
                    <div class="markdownZone">{{ $description->description }}</div>
                    <p class="info-user-description grey-text">
                        par {{$description->user->name}} le {{$description->created_at->format('d M Y')}}

                        @if(Auth::check())
                            <i data-modal="{'id':{{$description->id}}, 'model':'Description'}" data-route="{{route('problemModal')}}" data-target="modal" class="material-icons tiny-btn right tooltipped btnModal" data-position="top" data-delay="50" data-tooltip="Signaler un problème">flag</i>
                            @if($description->user_id == Auth::id())
                                <i data-modal="{'crag_id':{{$crag->id}}, 'description_id':{{$description->id}}, 'title':'Modifier la description', 'method' : 'PUT'}" data-route="{{route('descriptionModal')}}" data-target="modal" class="material-icons tiny-btn right tooltipped btnModal" data-position="top" data-delay="50" data-tooltip="Modifier cette déscription">edit</i>
                                <i data-modal="{'route' : '/descriptions/{{$description->id}}'}" data-route="{{route('deleteModal')}}" data-target="modal" class="material-icons tiny-btn right tooltipped btnModal" data-position="top" data-delay="50" data-tooltip="Supprimer cette déscription">delete</i>
                            @endif
                        @endif
                    </p>
                </div>
            @endforeach
        </div>

        {{--BOUTON POUR AJOUTER UNE DESCRIPTION--}}
        @if(Auth::check())
            <div class="text-right">
                <a data-modal="{'crag_id':{{$crag->id}}, 'description_id':'', 'title':'Ajouter une description', 'method' : 'POST'}" data-route="{{route('descriptionModal')}}" data-target="modal" id="description-btn-modal" data-position="top" data-delay="50" data-tooltip="Rédiger une déscription"  class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
            </div>
        @endif
    </div>
</div>
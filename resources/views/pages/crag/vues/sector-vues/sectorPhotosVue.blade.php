@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row row-crag-gallerie">

    @if(count($sector->photos) > 0)

        <div id="zone-sector-gallerie-{{$sector->id}}">
            <div id="sectorPhototheque-{{$sector->id}}" class="phototheque">
                @foreach($sector->photos as $photo)
                    <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>posté sur : <a href='/site-escalade/{{$sector->crag_id}}/{{str_slug($sector->label)}}#voie'>{{$sector->label}}</a> par <a>{{$photo->user_id}}</a>" alt="{{$sector->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                @endforeach
            </div>
        </div>

        @if(Auth::check())

            <div class="col s12" id="bt-show-sector-gallerie-editor-{{$sector->id}}">
                <div class="info-user grey-text i-cursor">
                    <i {!! $Helpers::tooltip('Modifier / supprimer ou signaler un problème sur une photo') !!} onclick="showPhotoSectorEditor(true, {{$sector->id}})" class="material-icons tiny-btn right tooltipped">edit</i>
                </div>
            </div>

            <div class="col s12 zone-photo-editor" id="zone-sector-photo-editor-{{$sector->id}}">

                <h2 class="loved-king-font text-center">Action sur une photo</h2>

                <div class="row">
                    @foreach($sector->photos as $photo)
                        <div class="col s6 m4 l3 text-center">
                            <div class="card">
                                <div class="card-image">
                                    <img alt="{{$sector->label}} - {{$photo->description}}" style="height: 100px; object-fit: cover" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                                </div>
                                <div class="card-content i-cursor">
                                    <p>
                                        <i {!! $Helpers::tooltip('Définir comme bandeau du site') !!} {!! $Helpers::modal(route('bandeauModal'), ["photo_id"=>$photo->id, "crag_id"=>$sector->crag_id]) !!} class="material-icons tiny-btn tooltipped btnModal">wallpaper</i>
                                        <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$photo->id, "model"=>"Photo"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                                        @if(Auth::id() == $photo->user_id)
                                            <i {!! $Helpers::tooltip('Modifier la photo') !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$sector->id, "illustrable_type"=>"Sector", "photo_id"=>$photo->id, "title"=>"Modifier une photo", "method"=>"PUT", "callback"=>"reloadPhotoSector"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                            <i {!! $Helpers::tooltip('Supprimer la photo') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/photos/" . $photo->id, "callback"=>"reloadPhotoSector"]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="info-user grey-text i-cursor col s12">
                        <i {!! $Helpers::tooltip('fermer l\'édition des photos') !!} onclick="showPhotoSectorEditor(false, {{$sector->id}})" class="material-icons tiny-btn right tooltipped">clear</i>
                    </div>
                </div>
            </div>
        @endif

    @else
        <p class="text-center grey-text">Il n'y a pas encore de photo postée sur ce secteur</p>
    @endif

    {{--BOUTON POUR AJOUTER UNE PHOTO--}}
    @if(Auth::check())
        <div class="text-right">
            <a {!! $Helpers::tooltip('Ajouter une photo') !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$sector->id, "illustrable_type"=>"Sector", "photo_id"=>'', "title"=>"Ajouter une photo", "method"=>"POST", "callback"=>"reloadPhotoSector"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
        </div>
    @endif
</div>
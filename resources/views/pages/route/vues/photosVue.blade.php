@inject('Helpers','App\Lib\HelpersTemplates')

@if(count($route->photos) > 0)

    <div id="zone-route-gallerie">
        <div class="row row-crag-gallerie">
            <div id="routePhototheque" class="phototheque">
                @foreach($route->photos as $photo)
                    <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>posté sur : <a href='/site-escalade/{{$route->crag_id}}/{{str_slug($route->label)}}'>{{$route->label}}</a> par <a>{{$photo->user_id}}</a>" alt="{{$route->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                @endforeach
            </div>
        </div>
    </div>


    @if(Auth::check())

        <div class="row" id="bt-show-route-gallerie-editor">
            <div class="info-user grey-text i-cursor">
                <i {!! $Helpers::tooltip('Modifier / supprimer ou signaler un problème sur une photo') !!} onclick="showRoutePhotoEditor(true)" class="material-icons tiny-btn right tooltipped">edit</i>
            </div>
        </div>

        <div class="row zone-photo-editor" id="zone-route-photo-editor">

            <div class="row">
                @foreach($route->photos as $photo)
                    <div class="col s6 m6 l4 text-center">
                        <div class="card">
                            <div class="card-image">
                                <img alt="{{$route->label}} - {{$photo->description}}" style="height: 100px; object-fit: cover" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                            </div>
                            <div class="card-content i-cursor">
                                <p>
                                    <i {!! $Helpers::tooltip('Définir comme bandeau du site') !!} {!! $Helpers::modal(route('bandeauModal'), ["photo_id"=>$photo->id, "crag_id"=>$route->crag_id]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">wallpaper</i>
                                    <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$photo->id, "model"=>"Photo"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">flag</i>
                                    @if(Auth::id() == $photo->user_id)
                                        <i {!! $Helpers::tooltip('Modifier la photo') !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$route->id, "illustrable_type"=>"Crag", "photo_id"=>$photo->id, "title"=>"Modifier une photo", "method"=>"PUT", "callback"=>"reloadRoutePhotoTab"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">edit</i>
                                        <i {!! $Helpers::tooltip('Supprimer la photo') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/photos/" . $photo->id, "callback"=>"reloadRoutePhotoTab"]) !!} class="material-icons tiny-btn tooltipped btnModal" onclick="$('#modal').modal('open');">delete</i>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="info-user grey-text i-cursor col s12">
                    <i {!! $Helpers::tooltip('fermer l\'édition des photos') !!} onclick="showRoutePhotoEditor(false)" class="material-icons tiny-btn right tooltipped" onclick="$('#modal').modal('open');">clear</i>
                </div>
            </div>
        </div>
    @endif

@else
    <p class="text-center grey-text">Il n'y a pas encore de photo postée sur cette ligne</p>
@endif

{{--BOUTON POUR AJOUTER UNE PHOTO--}}
@if(Auth::check())
    <div class="text-right btn-route-add">
        <a {!! $Helpers::tooltip('Ajouter une photo') !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$route->id, "illustrable_type"=>"Route", "photo_id"=>'', "title"=>"Ajouter une photo", "method"=>"POST", "callback"=>"reloadRoutePhotoTab"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal" onclick="$('#modal').modal('open');"><i class="material-icons">add</i></a>
    </div>
@endif
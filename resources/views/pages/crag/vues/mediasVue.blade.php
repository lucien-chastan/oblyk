@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            <h2 class="loved-king-font text-center">Photos de la falaise</h2>

            <div class="row row-crag-gallerie">
                <div id="cragPhototheque" class="phototheque">
                    @foreach($crag->photos as $photo)
                        <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>posté sur : <a href='/site-escalade/{{$crag->id}}/{{str_slug($crag->label)}}'>{{$crag->label}}</a> par <a>{{$photo->user_id}}</a>" alt="{{$crag->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                    @endforeach
                </div>
            </div>

            @if(Auth::check())
                <div class="row">
                    <div class="info-user grey-text">
                        <i {!! $Helpers::tooltip('Modifier / supprimer ou signaler un problème sur une photo') !!} class="material-icons tiny-btn right tooltipped">edit</i>
                    </div>
                </div>

                <div class="row">

                    <h2 class="loved-king-font text-center">Action sur une photo</h2>

                    @foreach($crag->photos as $photo)
                        <div class="col s6 m4 l2 text-center">
                            <div class="card">
                                <div class="card-image">
                                    <img alt="{{$crag->label}} - {{$photo->description}}" style="height: 100px; object-fit: cover" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                                </div>
                                <div class="card-content">
                                    <p>
                                        <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$photo->id, "model"=>"Photo"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                                        @if(Auth::id() == $photo->user_id)
                                            <i {!! $Helpers::tooltip('Modifier la photo') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$photo->id, "model"=>"Photo"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                            <i {!! $Helpers::tooltip('Supprimer la photo') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/photos/" . $photo->id]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <h2 class="loved-king-font text-center">Vidéos</h2>

            {{--bouton d'ajout--}}
            @if(Auth::check())
                <div class="fixed-action-btn horizontal">
                    <a class="btn-floating btn-large red">
                        <i class="large material-icons">add</i>
                    </a>
                    <ul>
                        <li><a {!! $Helpers::tooltip('Ajouter une photo') !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$crag->id, "illustrable_type"=>"Crag", "photo_id"=>'', "title"=>"Ajouter une photo", "method"=>"POST"]) !!} class="tooltipped btn-floating blue btnModal"><i class="material-icons">photo_camera</i></a></li>
                        <li><a {!! $Helpers::tooltip('Ajouter une vidéo') !!} class="tooltipped btn-floating blue"><i class="material-icons">videocam</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
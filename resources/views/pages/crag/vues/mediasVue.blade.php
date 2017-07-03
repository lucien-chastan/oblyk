@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            <h2 class="loved-king-font text-center">Photos</h2>

            <div id="myPhototheque" class="phototheque">
                @foreach($crag->photos as $photo)
                    <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}" alt="{{$crag->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                @endforeach
            </div>

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
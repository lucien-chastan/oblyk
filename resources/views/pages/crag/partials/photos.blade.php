<div class="col s12">
    <div class="card-panel">
        <h2 class="loved-king-font">Photos</h2>
        <div class="row row-crag-gallerie">

            @if(count($crag->photos) > 0)

                <div id="accueilPhototheque" class="phototheque">
                    @foreach($crag->photos as $photo)
                        <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>posté sur : <a href='/site-escalade/{{$crag->id}}/{{str_slug($crag->label)}}'>{{$crag->label}}</a> par <a>{{$photo->user_id}}</a>" alt="{{$crag->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                    @endforeach
                </div>

                <div class="col s12">
                    <p class="text-right"><a data-route="{{route('vueMediasCrag',[$crag->id])}}" data-callback="initPhotothequeCrag" class="router-link" onclick="$('ul.tabs').tabs('select_tab', 'medias');" href="#medias">voir plus</a></p>
                </div>
            @else
            <p class="grey-text text-center">Il n'y a pas encore de photo postée sur ce site</p>
            @endif
        </div>
    </div>
</div>
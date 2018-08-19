<div class="col s12">
    <div class="card-panel">
        <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.photoTitle')</h2>
        <div class="row row-crag-gallerie">

            @if(count($crag->photos) > 0)

                <div id="accueilPhototheque" class="phototheque">
                    @foreach($crag->photos as $photo)
                        <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>{{ trans('modals/photo.dataLegende', ['elementUrl'=>$crag->url(), 'elementLabel'=>$crag->label, 'userUrl'=>$photo->user->url(), 'userName'=>$photo->user->name]) }}" alt="{{$crag->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                    @endforeach
                </div>

                <div class="col s12">
                    <p class="text-right"><a data-route="{{route('vueMediasCrag',[$crag->id])}}" data-callback="initPhotothequeCrag" class="router-link" onclick="$('ul.tabs').tabs('select_tab', 'medias');" href="#medias">@lang('pages/crags/tabs/informations.btSeeMore')</a></p>
                </div>
            @else
            <p class="grey-text text-center">@lang('pages/crags/tabs/informations.paraNoPhoto')</p>
            @endif
        </div>
    </div>
</div>
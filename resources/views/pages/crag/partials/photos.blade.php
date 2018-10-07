<div class="col s12">
    <div class="card-panel">
        <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.photoTitle')</h2>
        <div class="row row-crag-gallerie">

            @if(count($cragPhotos) > 0)

                @include('includes.gallery', ['photos' => $cragPhotos])

                <div class="col s12">
                    <p class="text-right"><a data-route="{{route('vueMediasCrag',[$crag->id])}}" class="router-link" onclick="$('ul.tabs').tabs('select_tab', 'medias');" href="#medias">@lang('pages/crags/tabs/informations.btSeeMore')</a></p>
                </div>
            @else
                <p class="grey-text text-center">@lang('pages/crags/tabs/informations.paraNoPhoto')</p>
            @endif
        </div>
    </div>
</div>
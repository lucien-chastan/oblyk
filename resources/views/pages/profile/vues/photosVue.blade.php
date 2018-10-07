@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            <h2 class="loved-king-font titre-profile-boite-vue">{{$album->label}}</h2>

            <p>
                {{$album->description}}<br>
                <span class="grey-text">@choice('pages/profile/photo.nbPhoto', count($album->photos))</span>
            </p>

            @include('includes.gallery', ['photos' => $album->photos])

            <p><a class="text-cursor" onclick="reloadCurrentVue()"><i class="material-icons left">arrow_back</i> @lang('pages/profile/photo.backToAlbum')</a></p>

        </div>
    </div>
</div>
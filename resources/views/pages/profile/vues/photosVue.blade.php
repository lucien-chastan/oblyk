@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            <h2 class="loved-king-font titre-profile-boite-vue">{{$album->label}}</h2>

            <p>
                {{$album->description}}<br>
                <span class="grey-text">{{count($album->photos)}} photos</span>
            </p>

            <div id="albumPhototheque" class="phototheque">
                @foreach($album->photos as $photo)
                    <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>posté sur : <a href=''></a>" alt="{{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                @endforeach
            </div>

            <p><a class="text-cursor" onclick="reloadCurrentVue()"><i class="material-icons left">arrow_back</i> Retourner aux albums</a></p>

        </div>
    </div>
</div>
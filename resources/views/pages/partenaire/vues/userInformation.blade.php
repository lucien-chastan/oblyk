@inject('Helpers','App\Lib\HelpersTemplates')

<div class="user-partner-bandeau grey darken-1" style="background-image: url('{{$user->bandeau}}')">

    <div class="left-col">
        <img src="{{$user->image}}" alt="photo de profil de {{$user->name}} " class="circle img-nav-user z-depth-3">
    </div>

    <div class="right-col">
        <p class="truncate text-bold loved-king-font"><a href="{{ route('userPage',['user_id'=>$user->id,'user_label'=>str_slug($user->name)]) }}" class="white-text">{{$user->name}}</a></p>
        <p class="truncate">{{$user->genre}}, {{$user->age}} ans</p>
    </div>

</div>

<div class="row">
    <div class="col s12">
        <a class="right" href="{{ route('userPage',['user_id'=>$user->id,'user_label'=>str_slug($user->name)]) }}">Voir mon profil</a>
        <h2 class="loved-king-font">Ma description : </h2>
        @if($user->partnerSettings->description != '')
            <div class="markdownZone">
                @markdown($user->partnerSettings->description)
            </div>
        @else
            <p class="grey-text text-center">{{$user->name}} n'a pas rédigé de description</p>
        @endif
    </div>

    <div class="col s12">
        <p class="text-underline text-bold">Mon niveau en escalade :</p>
        <p class="no-margin">
            Je grimpe entre le <span class="color-grade-{{$user->partnerSettings->grade_min_val}} text-bold">{{$user->partnerSettings->grade_min}}</span> et le <span class="color-grade-{{$user->partnerSettings->grade_max_val}} text-bold">{{$user->partnerSettings->grade_max}}</span>
        </p>
    </div>

    <div class="col s12">
        <p class="text-underline text-bold">Je grimpe où ?</p>
        <div class="blue-border-zone">
            @foreach($user->places as $place)
                <div title="Cliquez pour afficher sur la carte" class="blue-border-div place-div" onclick="zoomOn({{ $place->lat }}, {{ $place->lng }})">
                    <p class="no-margin"><i class="material-icons left blue-text">location_on</i> {{$place->label}}</p>
                    <div class="markdownZone grey-text">@markdown($place->description)</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col s12">
        <p class="text-underline text-bold">Mes styles d'escalades :</p>
        <p class="text-center no-margin">
            @if($user->partnerSettings->climb_2 == 1) <img {!! $Helpers::tooltip('Bloc') !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-2.png"> @endif
            @if($user->partnerSettings->climb_3 == 1) <img {!! $Helpers::tooltip('Voie') !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-3.png"> @endif
            @if($user->partnerSettings->climb_4 == 1) <img {!! $Helpers::tooltip('Grande-voie') !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-4.png"> @endif
            @if($user->partnerSettings->climb_5 == 1) <img {!! $Helpers::tooltip('Trad') !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-5.png"> @endif
            @if($user->partnerSettings->climb_6 == 1) <img {!! $Helpers::tooltip('Artif') !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-6.png"> @endif
            @if($user->partnerSettings->climb_7 == 1) <img {!! $Helpers::tooltip('Deep-water') !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-7.png"> @endif
            @if($user->partnerSettings->climb_8 == 1) <img {!! $Helpers::tooltip('Via-ferrata') !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-8.png"> @endif
        </p>
    </div>

</div>

<div class="row">
    <div class="col s12 text-right">
        <a onclick="newMessage({{ $user->id }}, this)" class="btn-flat waves-effect blue-text"><i class="material-icons left">email</i>Me contacter</a>
    </div>
</div>

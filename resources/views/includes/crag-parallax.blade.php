<div class="parallax-container crag-parallax">
    <div class="row entete-info container">
        <div class="square-entete">
            <img src="/img/site-{{$crag_type}}.svg" alt="">
        </div>
        <div class="liste-info">
            <h1 class="loved-king-font"><span>site escalade </span>{{$label}}</h1>
            <p><a class="white-text" href="{{ route('map') }}#{{$lat}}/{{$lng}}/15">{{$city}}, {{$region}} ({{$code_country}})</a></p>
            @if(Auth::check())
                <p onclick="followedElement(this, 'Crag', {{$crag->id}})" class="follow-paragraphe" data-followed="{{$user_follow}}">
                    <span id="followed-element"><i class="material-icons amber-text">star</i> Ne plus suivre ce site</span>
                    <span id="not-followed-element"><i class="material-icons with-text">star_border</i> Suivre ce site</span>
                </p>
            @else
                <p>Connectez-vous pour suivre ce site</p>
            @endif
        </div>
    </div>
    <div class="parallax">
        <img class="img-crag-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>
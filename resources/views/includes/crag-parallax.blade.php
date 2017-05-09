<div class="parallax-container crag-parallax">
    <div class="parallax">
        <img class="img-crag-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
        <div class="row entete-info container">
            <div class="square-entete">
                <img src="/img/site-{{$crag_type}}.svg" alt="">
            </div>
            <div class="liste-info">
                <h1 class="loved-king-font"><span>site escalade </span>{{$label}}</h1>
                <p>{{$city}}, {{$region}} ({{$code_country}})</p>
                <p>x follower</p>
            </div>
        </div>
    </div>
    @if(Auth::check())
        <i data-position="bottom" data-delay="50" data-tooltip="Changer la photo de bandeau" class="tooltipped material-icons right icon-change-bandeau">camera_alt</i>
    @endif
</div>
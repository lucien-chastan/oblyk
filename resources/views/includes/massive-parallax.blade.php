<div class="parallax-container massive-parallax">
    <div class="row entete-info container">
        <div class="square-entete">
            <img src="/img/icon-massive.svg" alt="">
        </div>
        <div class="liste-info">
            <h1 class="loved-king-font">{{$label}}</h1>
            <p>{{$nbCrags}} sites d'escalade</p>
            @if(Auth::check())
                <p onclick="followedElement(this, 'Massive', {{$massive->id}})" class="follow-paragraphe" data-followed="{{$user_follow}}">
                    <span id="followed-element"><i class="material-icons amber-text">star</i> Ne plus suivre ce groupe</span>
                    <span id="not-followed-element"><i class="material-icons with-text">star_border</i> Suivre ce groupe</span>
                </p>
            @else
                <p>Connectez-vous pour suivre ce regroupement</p>
            @endif
        </div>
    </div>
    <div class="parallax">
        <img class="img-massive-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>
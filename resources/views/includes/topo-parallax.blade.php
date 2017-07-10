<div class="parallax-container topo-parallax">
    <div class="row entete-info container">
        <div class="square-entete">
            <img src="/img/icon-topo.svg" alt="">
        </div>
        <div class="liste-info">
            <h1 class="loved-king-font">{{$label}}</h1>
            <p>{{$author}}, {{$editor}} ({{$editionYear}})</p>
            @if(Auth::check())
                <p onclick="followedElement(this, 'Topo', {{$topo->id}})" class="follow-paragraphe" data-followed="{{$user_follow}}">
                    <span id="followed-element"><i class="material-icons amber-text">star</i> Ne plus suivre ce topo</span>
                    <span id="not-followed-element"><i class="material-icons with-text">star_border</i> Suivre ce topo</span>
                </p>
            @else
                <p>Connectez-vous pour suivre ce topo</p>
            @endif
        </div>
    </div>
    <div class="parallax">
        <img class="img-topo-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>
<div class="parallax-container topo-parallax">
    <div class="row entete-info container">
        <div class="square-entete">
            <img src="/img/icon-topo.svg" alt="">
        </div>
        <div class="liste-info">
            <h1 class="loved-king-font">{{$label}}</h1>
            <p>{{$author}}, {{$editor}} ({{$editionYear}})</p>
            @if(Auth::check())
                <p onclick="followedElement(this, 'Topo', {{$topo->id}}, 'Topo ajouter à ma Topothèque', 'Topo retiré de ma Topothèque')" class="follow-paragraphe" data-followed="{{$user_follow}}">
                    <span id="followed-element"><i class="material-icons amber-text">photo_album</i> Retirer de ma Topothèque</span>
                    <span id="not-followed-element"><i class="material-icons with-text">photo_album</i> Ajouter à ma Topothèque</span>
                </p>
            @else
                <p>Connectez-vous pour ajouter ce topo à votre Topothèque</p>
            @endif
        </div>
    </div>
    <div class="parallax">
        <img class="img-topo-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>
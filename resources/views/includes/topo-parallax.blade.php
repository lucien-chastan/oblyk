<div class="parallax-container topo-parallax">
    <div class="row entete-info container">
        <div class="square-entete">
            <img src="/img/icon-topo.svg" alt="">
        </div>
        <div class="liste-info">
            <h1 class="loved-king-font">{{$label}}</h1>
            <p>{{$author}}, {{$editor}} ({{$editionYear}})</p>
            @if(Auth::check())
                <p onclick="followedElement(this, 'Topo', {{$topo->id}}, '@lang('pages/guidebooks/global.addedLibrary')', '@lang('pages/guidebooks/global.deletedLibrary')')" class="follow-paragraphe" data-followed="{{$user_follow}}">
                    <span id="followed-element"><i class="material-icons amber-text">photo_album</i> @lang('pages/guidebooks/global.deleteInLibrary')</span>
                    <span id="not-followed-element"><i class="material-icons with-text">photo_album</i> @lang('pages/guidebooks/global.addInLibrary')</span>
                </p>
            @else
                <p>@lang('pages/guidebooks/global.connectForLibrary')</p>
            @endif
        </div>
    </div>
    <div class="parallax">
        <img class="img-topo-parallax" src="{{$imgSrc}}" alt="{{$imgAlt}}">
    </div>
</div>
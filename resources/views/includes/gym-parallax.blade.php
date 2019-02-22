<div class="parallax-container gym-parallax">
    <div class="row entete-info container">
        <div class="square-entete relative" style="position: relative">
            <img src="{{ $logo }}" alt="">
        </div>
        <div class="liste-info">
            <h1 class="loved-king-font"><span>@lang('pages/gyms/global.hiddenTitle') </span>{{ $label }}</h1>
            <p><a class="white-text" href="{{route('map')}}#{{ $lat }}/{{ $lng }}/15">{{ $city }}, {{ $region }} ({{ $code_country }})</a></p>
            @if(Auth::check())
                <p onclick="followedElement(this, 'Gym', {{ $gym->id }})" class="follow-paragraphe" data-followed="{{ $user_follow }}">
                    <span id="followed-element"><i class="material-icons amber-text">star</i> @lang('pages/gyms/global.noFollowThisGym')</span>
                    <span id="not-followed-element"><i class="material-icons with-text">star_border</i> @lang('pages/gyms/global.followThisGym')</span>
                </p>
            @else
                <p>@lang('pages/gyms/global.registerToFollow')</p>
            @endif
        </div>
    </div>
    <div class="parallax">
        <img class="img-gym-parallax" src="{{ $imgSrc }}" alt="{{ $imgAlt }}">
    </div>
</div>
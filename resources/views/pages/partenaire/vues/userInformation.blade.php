@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="user-partner-bandeau grey darken-1" style="background-image: url('{{$user->bandeau}}')">

    <div class="left-col">
        <img src="{{$user->image}}" alt="photo de profil de {{$user->name}} " class="circle img-nav-user z-depth-3">
    </div>

    <div class="right-col">
        <p class="truncate text-bold loved-king-font"><a href="{{ $user->url() }}" class="white-text">{{$user->name}}</a></p>
        <p class="truncate">{{$user->genre}}, {{$user->age}}</p>
    </div>

</div>


@if(Auth::check())

    @if($authUser->birth == 0 || $authUser->birth > date('Y') - 18)

        <div class="row">
            <div class="col s12">
                @if($authUser->birth == 0)
                    <p>
                        @lang('pages/partner/partnerMap.birth')
                    </p>
                    <form class="submit-form" data-route="{{route('saveUserBirth')}}" onsubmit="submitData(this, refresh); return false">
                        {!! $Inputs::popupError() !!}

                        {!! $Inputs::text(['name'=>'birth', 'label'=>trans('pages/partner/partnerMap.labelBirth'), 'value'=>'', 'type'=>'number']) !!}

                        {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

                        <div class="row">
                            {!! $Inputs::Submit(['label'=>trans('pages/partner/partnerMap.submitBirth'), 'cancelable' => false]) !!}
                        </div>

                    </form>
                @else
                    <p>
                        @lang('pages/partner/partnerMap.noResponsibility_1')
                    </p>
                    <p>
                        @lang('pages/partner/partnerMap.noResponsibility_2')
                    </p>
                @endif
            </div>
        </div>
    @else
        <div class="row">
            <div class="col s12">
                <a class="right" href="{{ $user->url() }}">@lang('pages/partner/userView.actionSeeProfil')</a>
                <h2 class="loved-king-font">@lang('pages/partner/userView.titleDescription') </h2>
                @if($user->partnerSettings->description != '')
                    <div class="markdownZone">
                        @markdown($user->partnerSettings->description)
                    </div>
                @else
                    <p class="grey-text text-center">
                        @lang('pages/partner/userView.noDescription', ['name'=>$user->name])
                    </p>
                @endif
            </div>

            <div class="col s12">
                <p class="text-underline text-bold">@lang('pages/partner/userView.climbingLevelTitle')</p>
                <p class="no-margin">
                    {!! trans('pages/partner/userView.minMax', [
                        'name'=>$user->name,
                        'min'=>'<span class="color-grade-' . $user->partnerSettings->grade_min_val .' text-bold">' . $user->partnerSettings->grade_min . '</span>',
                        'max'=>'<span class="color-grade-' . $user->partnerSettings->grade_max_val .' text-bold">' . $user->partnerSettings->grade_max . '</span>',
                    ]) !!}
                </p>
            </div>

            <div class="col s12">
                <p class="text-underline text-bold">@lang('pages/partner/userView.placesTitle')</p>
                <div class="blue-border-zone">
                    @foreach($user->places as $place)
                        <div title="@lang('pages/partner/userView.tooltipClickMap')" class="blue-border-div place-div" onclick="zoomOn({{ $place->lat }}, {{ $place->lng }})">
                            <p class="no-margin"><i class="material-icons left blue-text">location_on</i> {{$place->label}}</p>
                            <div class="markdownZone grey-text">@markdown($place->description)</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col s12">
                <p class="text-underline text-bold">@lang('pages/partner/userView.climbingTypeTitle') :</p>
                <p class="text-center no-margin">
                    @if($user->partnerSettings->climb_2 == 1) <img {!! $Helpers::tooltip(trans('elements/climbs.climb_2')) !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-2.png"> @endif
                    @if($user->partnerSettings->climb_3 == 1) <img {!! $Helpers::tooltip(trans('elements/climbs.climb_3')) !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-3.png"> @endif
                    @if($user->partnerSettings->climb_4 == 1) <img {!! $Helpers::tooltip(trans('elements/climbs.climb_4')) !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-4.png"> @endif
                    @if($user->partnerSettings->climb_5 == 1) <img {!! $Helpers::tooltip(trans('elements/climbs.climb_5')) !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-5.png"> @endif
                    @if($user->partnerSettings->climb_6 == 1) <img {!! $Helpers::tooltip(trans('elements/climbs.climb_6')) !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-6.png"> @endif
                    @if($user->partnerSettings->climb_7 == 1) <img {!! $Helpers::tooltip(trans('elements/climbs.climb_7')) !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-7.png"> @endif
                    @if($user->partnerSettings->climb_8 == 1) <img {!! $Helpers::tooltip(trans('elements/climbs.climb_8')) !!} class="tooltipped image-type-grimpe" src="/img/icon-climb-8.png"> @endif
                </p>
            </div>

        </div>

        <div class="row">
            <div class="col s12 text-right">
                <a onclick="newMessage({{ $user->id }}, this)" class="btn-flat waves-effect blue-text"><i class="material-icons left">email</i>@lang('pages/partner/userView.action', ['name'=>$user->name])</a>
            </div>
        </div>

    @endif

@else
    <div class="row">
        <div class="col s12">
            <p class="text-center grey-text">
                @lang('pages/partner/userView.accountFor', ['name'=>$user->name])
            </p>
            <p class="text-center">
                <a class="btn" href="{{ route('register') }}">@lang('pages/partner/userView.registerAction')</a><br>
                <a href="{{ route('login') }}">@lang('pages/partner/userView.loginAction')</a>
            </p>
        </div>
    </div>
@endif


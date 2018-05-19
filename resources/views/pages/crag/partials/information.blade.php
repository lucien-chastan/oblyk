<div class="card-panel">
    <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.boxInformationTitle', ['name'=>$crag->label])</h2>
    <p>
        @lang(
            'pages/crags/tabs/informations.boxInformationShortDescription',
             [
                'name'=>$crag->label,
                'climbs_type'=>$climbTypes,
                'rock'=> trans('elements/rocks.rock_' . $crag->rock->id),
                'city'=> $crag->city,
                'region'=> $crag->region,
                'code_country'=> $crag->code_country,
             ]
        )
        <br>
        {{ trans_choice('pages/crags/tabs/informations.boxInformationNbRoute', $crag->routes_count) }}
        @if($crag->routes_count > 0)
            {!! trans('pages/crags/tabs/informations.boxInformationGapGrade',
                [
                    'min'=>'<strong class="color-grade-' . $crag->gapGrade->min_grade_val . '">' . $crag->gapGrade->min_grade_text . '</strong>',
                    'max'=>'<strong class="color-grade-' . $crag->gapGrade->max_grade_val . '">' . $crag->gapGrade->max_grade_text . '</strong>',
                ]
            ) !!}
        @endif
    </p>

    {{-- INTERFICTION, CONVENTION, ETC--}}
    @if(count($crag->exceptions) > 0)
        @foreach($crag->exceptions as $exception)

            @if($exception->exception_type == 1)
                <p class="red-text text-bold">
                    <i class="material-icons left">report_problem</i> @lang('pages/crags/tabs/informations.boxInformationTitleInterdiction')
                </p>
            @endif

            @if($exception->exception_type == 2)
                <p class="orange-text text-bold"><i class="material-icons left">error</i>@lang('pages/crags/tabs/informations.boxInformationTitleRestrictedAccess')</p>
            @endif

            @if($exception->exception_type == 3)
                <p class="text-bold ffme-color"><img src="/img/logo_ffme.svg" class="logo-exceptions-crag"> @lang('pages/crags/tabs/informations.boxInformationTitleConventionSite', ['class'=>'inherit-color', 'url'=>'http://www.ffme.fr/'])</p>
            @endif

            @if($exception->exception_type == 4)
                <p class="text-bold greenspits-color"><img src="/img/logo_greenspits.svg" class="logo-exceptions-crag"> @lang('pages/crags/tabs/informations.boxInformationTitleGreenSpits', ['class'=>'inherit-color', 'url'=>'https://greenspits.com/fr/greenspits-projet-naissant-lavenir/'])</p>
            @endif

            <div class="markdownZone">{{$exception->description}}</div>

        @endforeach
    @endif

    {{--REGROUPEMENT--}}
    @if(count($crag->massives) > 0)
        <p>
            @lang('pages/crags/tabs/informations.boxInformationGroup', ['name'=>$crag->label])<br>
            @foreach($crag->massives as $liaison)
                - <a href="{{route('massivePage',['massive_id'=>$liaison->massive->id, 'massive_label'=>str_slug($liaison->massive->label)])}}">{{$liaison->massive->label}}</a><br>
            @endforeach
            @if(Auth::check())
                + <a {!! $Helpers::modal(route('massiveCragModal'), ["crag_id"=>$crag->id, "lat"=>$crag->lat, "lng"=>$crag->lng, "rayon"=>50, "title"=> trans('modals/massive.tooltip')]) !!} class="btnModal text-cursor">@lang('modals/massive.tooltip')</a>
            @endif
        </p>
    @else
        <p class="grey-text text-center">
            @lang('pages/crags/tabs/informations.boxInformationNotGroup', ['name'=>$crag->label])<br>
            @if(Auth::check())
                <a {!! $Helpers::modal(route('massiveCragModal'), ["crag_id"=>$crag->id, "lat"=>$crag->lat, "lng"=>$crag->lng, "rayon"=>50, "title"=> trans('modals/massive.tooltip')]) !!} class="btnModal text-cursor">@lang('modals/massive.tooltip')</a>
            @endif
        </p>
    @endif

    <div class="text-right ligne-btn">
        <span {!! $Helpers::tooltip( trans('modals/shareCrag.shareTooltip') ) !!} {!! $Helpers::modal(route('shareCragModal'), ["id"=>$crag->id, "title"=>trans('modals/shareCrag.shareTitle')]) !!}  class="tooltipped btnModal left share-btn grey-text">
            <i class="material-icons">reply</i> Partager
        </span>
        @if(Auth::check())
            <i {!! $Helpers::tooltip( trans('modals/crag.tooltip')) !!} {!! $Helpers::modal(route('cragModal'), ["id"=>$crag->id, "title"=>trans('modals/crag.modalTitle'), "method" => "PUT"]) !!} class="material-icons tooltipped btnModal">edit</i>
            @if($crag->versions_count > 0)
                <i {!! $Helpers::tooltip(trans('modals/version.tooltip')) !!} {!! $Helpers::modal(route('versionModal'), ["id"=>$crag->id, "model"=>"Crag"]) !!} class="material-icons tooltipped btnModal">history</i>
            @endif
        @endif
    </div>

</div>
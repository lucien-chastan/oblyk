<div class="card-panel">
    <h2 class="loved-king-font">@lang('pages/crags/tabs/informations.partnerTitle')</h2>
    <div class="blue-border-zone">
        @php($ImThere = false)
        @foreach($partners as $partner)

            @if($partner->id == Auth::id())
                @php($ImThere = true)
            @endif

            <div class="blue-border-div">
                <p class="no-margin">
                    <a href="{{ route('userPage',['user_id'=>$partner->id,'user_label'=>str_slug($partner->name)]) }}"><i class="material-icons left">person_pin_circle</i> {{ $partner->name }}</a>
                    <span class="grey-text">
                        @lang('elements/sex.sex_' . ($partner->sex ?? 0))
                        @if($partner->birth == 0) {{ trans_choice('elements/old.old', 0) }} @endif
                        @if($partner->birth != 0) {{ trans_choice('elements/old.old', date('Y') - $partner->birth) }} @endif
                    </span>
                </p>
            </div>
        @endforeach
    </div>

    @if(count($partners) == 0)
        <p class="grey-text text-center">@lang('pages/crags/tabs/informations.noPartnerPara')</p>
    @endif

    @if(Auth::check() && $ImThere == false)
        @if($user->partnerSettings->partner == 0)
            <p class="text-center">
                <a href="{{ route('userPage',['user_id'=>$user->id,'user_label'=>str_slug($user->name)]) }}#partenaire-parametres" class="btn-flat blue-text"><i class="material-icons left">person_pin</i> @lang('pages/crags/tabs/informations.activePartner')</a>
            </p>
        @else
            <p class="text-center">
                <a {!! $Helpers::modal(route('partnerModal'), ["place_id"=>"", "lat"=>$crag->lat, "lng"=>$crag->lng, "label"=>$crag->label, "rayon"=>2, "title"=> trans('modals/partner.modalAddPartner'), "method"=>"POST", "callback"=>"refresh" ]) !!} class="btn-flat blue-text btnModal"><i class="material-icons left">person_pin</i> @lang('modals/partner.btnAddPlaces')</a>
            </p>
        @endif
    @endif
</div>
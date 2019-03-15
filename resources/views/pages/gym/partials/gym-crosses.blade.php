<div class="col s12">
    <div class="card-panel">
        <h2 class="loved-king-font">@lang('pages/gyms/tabs/information.myCrosses')</h2>

        @if(count($crosses) > 0)
            <p>
                @lang('pages/gyms/tabs/information.crossesIntroduction', ['count_cross' => count($crosses), 'height' => $crossesHeight])
                (max <strong class="color-grade-{{ $crossesMaxGrade }}">{{ App\Route::valToGrad($crossesMaxGrade) }}</strong>)
            </p>
        @endif

        <div class="text-center">
            @if(isset($firstRoom) != 0)
                <a href="{{ $firstRoom->url() }}" class="waves-effect waves-light btn-flat">
                    <i class="material-icons left">view_quilt</i>@lang('pages/gyms/tabs/information.goGuideBook')
                </a>
            @endif
            <button class="waves-effect waves-light btn-flat btnModal" {!! $Helpers::modal(route('indoorCrossModal'), ["id" => "", "route_id"=>null, "room_id"=>null, "gym_id"=>$gym->id, "sector_id"=>null, "title"=> trans('pages/gym-schemes/global.addCrossGym'), "method"=>"POST"]) !!}>
                <i class="material-icons left">done</i>@lang('pages/gyms/tabs/information.addCross')
            </button>
            @if(count($crosses) > 0)
                <a href="{{ Auth::user()->url() }}#analytiks" class="waves-effect waves-light btn-flat"><i class="material-icons left">equalizer</i>@lang('pages/gyms/tabs/information.seeAnalyticks')</a>
            @endif
        </div>
    </div>
</div>
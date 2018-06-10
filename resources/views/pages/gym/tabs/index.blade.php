<div class="row stretchCol">

    {{--INOFRMATION SUR LA SALLE--}}
    <div class="col s12 m7">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/gyms/tabs/information.title', ['name'=>$gym->label])</h2>
            <p>
                @lang(
                    'pages/gyms/tabs/information.description',
                     [
                        'name'=>$gym->label,
                        'type'=>$gym->type,
                        'city'=>$gym->city,
                        'class'=>'grey-text',
                        'url'=>route('map') . '#' . $gym->lat . '/' . $gym->lng . '/15',
                        'address'=>$gym->address,
                        'postal_code'=>$gym->postal_code,
                     ]
                )
            </p>

            @markdown($gym->description)

            @if(Auth::check() && $administrator_count == 0)
                <div class="text-right ligne-btn">
                    <i {!! $Helpers::tooltip(trans('modals/gym.editTooltip')) !!} {!! $Helpers::modal(route('gymModal'), ["id"=>$gym->id, "title"=>trans('modals/gym.modalEditeTitle'), "method" => "PUT"]) !!} class="material-icons tooltipped btnModal">edit</i>
                </div>
            @endif

            @if($administrator_count == 0)
                <div class="text-center">
                    <button {!! $Helpers::modal(route('managerModal'), ['gym_id'=>$gym->id]) !!} class="btn-flat btnModal">
                        Je suis gérant de cette salle
                    </button>
                </div>
            @endif

        </div>
    </div>

    {{--PETITE INFORMATION SUR LA SALLE--}}
    <div class="col s12 m5">
        <div class="card-panel">
            <h2 class="loved-king-font">@lang('pages/gyms/tabs/information.titleAbout')</h2>
            <p><i class="material-icons left">phone</i>
                @if($gym->phone_number != '')
                    <a href="tel:{{ $gym->phone_number }}">
                        {{ $gym->phone_number }}
                    </a>
                @else
                    <span class="grey-text">@lang('pages/gyms/tabs/information.noPhoneNumber')</span>
                @endif
            </p>
            <p><i class="material-icons left">email</i>
                @if($gym->email != '')
                    <a href="mailto:{{ $gym->email }}">
                        {{ $gym->email }}
                    </a>
                @else
                    <span class="grey-text">@lang('pages/gyms/tabs/information.noEmail')</span>
                @endif
            </p>
            <p><i class="material-icons left">language</i>
                @if($gym->web_site != '')
                    <a href="{{ $gym->web_site }}" class="truncate">
                        {{ $gym->web_site }}
                    </a>
                @else
                    <span class="grey-text">@lang('pages/gyms/tabs/information.noWebSite')</span>
                @endif
            </p>
        </div>
    </div>
</div>

<div class="row">
    {{--DESCRIPTION--}}
    @include('pages.gym.partials.description')
</div>

<div class="row">
    {{--DESCRIPTION--}}
    @include('pages.gym.partials.partner')
</div>



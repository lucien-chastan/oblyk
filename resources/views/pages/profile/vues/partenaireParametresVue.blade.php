@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel partner-settings-zone">

            <button class="btn-flat right waves-effect blue-text" onclick="loadProfileRoute(document.getElementById('item-mes-lieux-nav'))">Mes Lieux<i class="material-icons right">arrow_forward</i></button>

            <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/partnerSearch.titleWhoIAm')</h2>

            <p>
                @lang('pages/profile/partnerSearch.explication')
            </p>

            <form id="form-partner-setting" class="submit-form" data-route="{{route('saveUserPartnerSettings')}}" onsubmit="submitData(this, majPartnerSettings); return false">

                {!! $Inputs::popupError([]) !!}

                <div class="blue-border-zone">

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">@lang('pages/profile/partnerSearch.step1Title')</p>
                        {!! $Inputs::checkbox(['name'=>'partner', 'label'=>trans('pages/profile/partnerSearch.labelActive'), 'checked' => ($user->partnerSettings->partner == 1) ? true : false, 'align' => 'left']) !!}

                        <p class="grey-text para-note-active-partner">@lang('pages/profile/partnerSearch.titleNote')</p>
                        <ul class="grey-text oblyk-ul">
                            <li>
                                @lang('pages/profile/partnerSearch.li1')
                            </li>
                            <li>
                                @lang('pages/profile/partnerSearch.li2')
                            </li>
                        </ul>
                    </div>

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">@lang('pages/profile/partnerSearch.step2Title')</p>
                        {!! $Inputs::checkbox(['name'=>'climb_2', 'label'=>trans('elements/climbs.climb_2'), 'checked' => ($user->partnerSettings->climb_2 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_3', 'label'=>trans('elements/climbs.climb_3'), 'checked' => ($user->partnerSettings->climb_3 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_4', 'label'=>trans('elements/climbs.climb_4'), 'checked' => ($user->partnerSettings->climb_4 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_5', 'label'=>trans('elements/climbs.climb_5'), 'checked' => ($user->partnerSettings->climb_5 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_6', 'label'=>trans('elements/climbs.climb_6'), 'checked' => ($user->partnerSettings->climb_6 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_7', 'label'=>trans('elements/climbs.climb_7'), 'checked' => ($user->partnerSettings->climb_7 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_8', 'label'=>trans('elements/climbs.climb_8'), 'checked' => ($user->partnerSettings->climb_8 == 1) ? true : false, 'align' => 'left']) !!}
                    </div>

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">@lang('pages/profile/partnerSearch.step3Title')</p>
                        <div class="input-field col s12">
                            <select id="grade_min" class="input-data" name="grade_min">
                                <option value="2a" @if($user->partnerSettings->grade_min == '2a') selected @endif >2a</option>
                                <option value="2b" @if($user->partnerSettings->grade_min == '2b') selected @endif >2b</option>
                                <option value="2c" @if($user->partnerSettings->grade_min == '2c') selected @endif >2c</option>

                                <option value="3a" @if($user->partnerSettings->grade_min == '3a') selected @endif >3a</option>
                                <option value="3b" @if($user->partnerSettings->grade_min == '3b') selected @endif >3b</option>
                                <option value="3c" @if($user->partnerSettings->grade_min == '3c') selected @endif >3c</option>

                                <option value="4a" @if($user->partnerSettings->grade_min == '4a') selected @endif >4a</option>
                                <option value="4b" @if($user->partnerSettings->grade_min == '4b') selected @endif >4b</option>
                                <option value="4c" @if($user->partnerSettings->grade_min == '4c') selected @endif >4c</option>

                                <option value="5a" @if($user->partnerSettings->grade_min == '5a') selected @endif >5a</option>
                                <option value="5b" @if($user->partnerSettings->grade_min == '5b') selected @endif >5b</option>
                                <option value="5c" @if($user->partnerSettings->grade_min == '5c') selected @endif >5c</option>

                                <option value="6a" @if($user->partnerSettings->grade_min == '6a') selected @endif >6a</option>
                                <option value="6b" @if($user->partnerSettings->grade_min == '6b') selected @endif >6b</option>
                                <option value="6c" @if($user->partnerSettings->grade_min == '6c') selected @endif >6c</option>

                                <option value="7a" @if($user->partnerSettings->grade_min == '7a') selected @endif >7a</option>
                                <option value="7b" @if($user->partnerSettings->grade_min == '7b') selected @endif >7b</option>
                                <option value="7c" @if($user->partnerSettings->grade_min == '7c') selected @endif >7c</option>

                                <option value="8a" @if($user->partnerSettings->grade_min == '8a') selected @endif >8a</option>
                                <option value="8b" @if($user->partnerSettings->grade_min == '8b') selected @endif >8b</option>
                                <option value="8c" @if($user->partnerSettings->grade_min == '8c') selected @endif >8c</option>

                                <option value="9a" @if($user->partnerSettings->grade_min == '9a') selected @endif >9a</option>
                                <option value="9b" @if($user->partnerSettings->grade_min == '9b') selected @endif >9b</option>
                                <option value="9c" @if($user->partnerSettings->grade_min == '9c') selected @endif >9c</option>
                            </select>
                            <label for="grade_min">@lang('pages/profile/partnerSearch.minLabel')</label>
                        </div>
                        <div class="input-field col s12">
                            <select id="grade_max" class="input-data" name="grade_max">
                                <option value="2a" @if($user->partnerSettings->grade_max == '2a') selected @endif >2a</option>
                                <option value="2b" @if($user->partnerSettings->grade_max == '2b') selected @endif >2b</option>
                                <option value="2c" @if($user->partnerSettings->grade_max == '2c') selected @endif >2c</option>

                                <option value="3a" @if($user->partnerSettings->grade_max == '3a') selected @endif >3a</option>
                                <option value="3b" @if($user->partnerSettings->grade_max == '3b') selected @endif >3b</option>
                                <option value="3c" @if($user->partnerSettings->grade_max == '3c') selected @endif >3c</option>

                                <option value="4a" @if($user->partnerSettings->grade_max == '4a') selected @endif >4a</option>
                                <option value="4b" @if($user->partnerSettings->grade_max == '4b') selected @endif >4b</option>
                                <option value="4c" @if($user->partnerSettings->grade_max == '4c') selected @endif >4c</option>

                                <option value="5a" @if($user->partnerSettings->grade_max == '5a') selected @endif >5a</option>
                                <option value="5b" @if($user->partnerSettings->grade_max == '5b') selected @endif >5b</option>
                                <option value="5c" @if($user->partnerSettings->grade_max == '5c') selected @endif >5c</option>

                                <option value="6a" @if($user->partnerSettings->grade_max == '6a') selected @endif >6a</option>
                                <option value="6b" @if($user->partnerSettings->grade_max == '6b') selected @endif >6b</option>
                                <option value="6c" @if($user->partnerSettings->grade_max == '6c') selected @endif >6c</option>

                                <option value="7a" @if($user->partnerSettings->grade_max == '7a') selected @endif >7a</option>
                                <option value="7b" @if($user->partnerSettings->grade_max == '7b') selected @endif >7b</option>
                                <option value="7c" @if($user->partnerSettings->grade_max == '7c') selected @endif >7c</option>

                                <option value="8a" @if($user->partnerSettings->grade_max == '8a') selected @endif >8a</option>
                                <option value="8b" @if($user->partnerSettings->grade_max == '8b') selected @endif >8b</option>
                                <option value="8c" @if($user->partnerSettings->grade_max == '8c') selected @endif >8c</option>

                                <option value="9a" @if($user->partnerSettings->grade_max == '9a') selected @endif >9a</option>
                                <option value="9b" @if($user->partnerSettings->grade_max == '9b') selected @endif >9b</option>
                                <option value="9c" @if($user->partnerSettings->grade_max == '9c') selected @endif >9c</option>
                            </select>
                            <label for="grade_max">@lang('pages/profile/partnerSearch.maxLabel')</label>
                        </div>
                        <p class="grey-text">
                            @lang('pages/profile/partnerSearch.noteLevel')
                        </p>
                    </div>

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">@lang('pages/profile/partnerSearch.step4Title')</p>
                        {!! $Inputs::mdText(['name'=>'description', 'label'=>trans('pages/profile/partnerSearch.LabelWhoIAm'), 'value'=>$user->partnerSettings->description]) !!}
                        <p class="grey-text">
                            @lang('pages/profile/partnerSearch.noteDescription')
                        </p>
                    </div>

                    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

                    <div class="row">
                        {!! $Inputs::Submit(['label'=>trans('pages/profile/partnerSearch.submit'), 'cancelable' => false]) !!}
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<form id="form-confidentialite-setting" class="submit-form row" data-route="{{route('saveUserConfidentialiteSettings')}}" onsubmit="submitData(this, majSettingsConfidentialite); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/settings.titlePrivacy')</h2>

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::checkbox(['name'=>'public', 'label'=>trans('pages/profile/settings.labelPublic'), 'checked' => ($user->settings->public == 1) ? true : false, 'align' => 'left']) !!}

    <p>
        <strong class="text-underline">@lang('pages/profile/settings.strongTitlePublic')</strong><br>
        @lang('pages/profile/settings.descriptionPublic')
    </p>

    <p>
        <strong class="text-underline">@lang('pages/profile/settings.strongTitlePrivate')</strong><br>
        @lang('pages/profile/settings.descriptionPrivate')
    </p>

    <div class="row">
        {!! $Inputs::Submit(['label'=>trans('pages/profile/settings.saveSubmit'), 'cancelable' => false]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

</form>
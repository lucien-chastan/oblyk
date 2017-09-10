<form id="form-dashboard-setting" class="submit-form" data-route="{{route('saveUserSettings')}}" onsubmit="submitData(this, majSettingsDashboard); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/settings.titleDashboard')</h2>

    {!! $Inputs::popupError([]) !!}

    <div class="blue-border-zone explication-dash-option">

        {{--WELCOME--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_welcome', 'label'=>trans('pages/profile/settings.labelWelcomeBox'), 'checked' => ($user->settings->dash_welcome == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionWelcomeBox')</p>
        </div>

        {{--CROIX DES POTES--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_friend_cross', 'label'=>trans('pages/profile/settings.labelFriendsCrossesBox'), 'checked' => ($user->settings->dash_friend_cross == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionFriendsCrossesBox')</p>
        </div>

        {{--TES CROIX--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_my_cross', 'label'=>trans('pages/profile/settings.labelMyCrossesBox'), 'checked' => ($user->settings->dash_my_cross == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionMyCrossesBox')</p>
        </div>

        {{--COMMENTAIRES--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_comments', 'label'=>trans('pages/profile/settings.labelLastCommentBox'), 'checked' => ($user->settings->dash_comments == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastCommentBox')</p>
        </div>

        {{--FALAISE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_crags', 'label'=>trans('pages/profile/settings.labelLastCragBox'), 'checked' => ($user->settings->dash_crags == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastCragBox')</p>
        </div>

        {{--LE FORUM--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_forum', 'label'=>trans('pages/profile/settings.labelLastTopicBox'), 'checked' => ($user->settings->dash_forum == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastTopicBox')</p>
        </div>

        {{--LISTE DES FALAISES ET SALLE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_list_crag_sae', 'label'=>trans('pages/profile/settings.labelCragGymTreeBox'), 'checked' => ($user->settings->dash_list_crag_sae == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionCragGymTreeBox')</p>
        </div>

        {{--DERNIER ARTICLE D'OBLYK--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_oblyk_news', 'label'=>trans('pages/profile/settings.labelNewsBox'), 'checked' => ($user->settings->dash_oblyk_news == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionNewsBox')</p>
        </div>

        {{--RECHERCHE DE PARTENAIRE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_partenaire', 'label'=>trans('pages/profile/settings.labelPartnerBox'), 'checked' => ($user->settings->dash_partenaire == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionPartnerBox')</p>
        </div>

        {{--DERNIÈRE PHOTOS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_photos', 'label'=>trans('pages/profile/settings.labelLastPhotoBox'), 'checked' => ($user->settings->dash_photos == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastPhotoBox')</p>
        </div>

        {{--DERNIÈRES LIGNES--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_routes', 'label'=>trans('pages/profile/settings.labelLastRouteBox'), 'checked' => ($user->settings->dash_routes == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastRouteBox')</p>
        </div>

        {{--DERNIÈRES SAE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_sae', 'label'=>trans('pages/profile/settings.labelLastGymBox'), 'checked' => ($user->settings->dash_sae == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastGymBox')</p>
        </div>

        {{--DERNIERS TOPOS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_topos', 'label'=>trans('pages/profile/settings.labelLastGuidebookBox'), 'checked' => ($user->settings->dash_topos == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastGuidebookBox')</p>
        </div>

        {{--DERNIERS GRIMPEURS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_users', 'label'=>trans('pages/profile/settings.labelLastClimberBox'), 'checked' => ($user->settings->dash_users == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastClimberBox')</p>
        </div>

        {{--DERNIÈRES VIDÉOS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_videos', 'label'=>trans('pages/profile/settings.labelLastVideoBox'), 'checked' => ($user->settings->dash_videos == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionLastVideoBox')</p>
        </div>

        {{--MOT AU HASARD--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_random_word', 'label'=>trans('pages/profile/settings.labelRandomWordBox'), 'checked' => ($user->settings->dash_random_word == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionRandomWordBox')</p>
        </div>

        {{--LES CONTRIBUTIONS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_contribution', 'label'=>trans('pages/profile/settings.labelContributionBox'), 'checked' => ($user->settings->dash_contribution == 1) ? true : false, 'align' => 'left']) !!}
            <p>@lang('pages/profile/settings.descriptionContributionBox')</p>
        </div>

        {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

        <div class="row">
            {!! $Inputs::Submit(['label'=>trans('pages/profile/settings.saveSubmit'), 'cancelable' => false]) !!}
        </div>

    </div>
</form>
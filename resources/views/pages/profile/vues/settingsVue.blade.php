@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <div class="col s12">
                    <ul class="tabs tabs-fixed-width tabs-settings-compte no-scroll-x">
                        <li class="tab col s2"><a onclick="activeSettingsTab = 'compte';" href="#compte"><i class="material-icons ic-tab-parametre-profile">person</i> <span class="hidden-1000">Compte</span></a></li>
                        <li class="tab col s2"><a onclick="activeSettingsTab = 'password';" href="#password"><i class="material-icons ic-tab-parametre-profile">settings_power</i> <span class="hidden-1000">Connexion</span></a></li>
                        <li class="tab col s2"><a onclick="activeSettingsTab = 'reseaux-sites';" href="#reseaux-sites"><i class="material-icons ic-tab-parametre-profile">language</i> <span class="hidden-1000">Liens</span></a></li>
                        <li class="tab col s2"><a onclick="activeSettingsTab = 'dashboard';" href="#dashboard"><i class="material-icons ic-tab-parametre-profile">dashboard</i> <span class="hidden-1000">Dashboard</span></a></li>
                        <li class="tab col s2"><a onclick="activeSettingsTab = 'messagerie';" href="#messagerie"><i class="material-icons ic-tab-parametre-profile">email</i> <span class="hidden-1000">Messagerie</span></a></li>
                        <li class="tab col s2"><a onclick="activeSettingsTab = 'confidentialite';" href="#confidentialite"><i class="material-icons ic-tab-parametre-profile">lock</i> <span class="hidden-1000">Confidentialité</span></a></li>
                    </ul>
                </div>
                <div id="compte" class="col s12">
                    @include('pages.profile.partials.settings.compteSettings')
                </div>
                <div id="password" class="col s12">
                    @include('pages.profile.partials.settings.passwordSettings')
                </div>
                <div id="reseaux-sites" class="col s12">
                    @include('pages.profile.partials.settings.reseauxSitesSettings')
                </div>
                <div id="dashboard" class="col s12">
                    @include('pages.profile.partials.settings.dashboardSettings')
                </div>
                <div id="messagerie" class="col s12">
                    @include('pages.profile.partials.settings.messagerieSettings')
                </div>
                <div id="confidentialite" class="col s12">
                    @include('pages.profile.partials.settings.confidentialiteSettings')
                </div>
            </div>

        </div>
    </div>
</div>
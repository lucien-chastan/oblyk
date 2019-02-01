
<ul class="collapsible" data-collapsible="accordion">

    {{-- Dashboard --}}
    <li>
        <a href="{{ route('admin_home') }}">
            <div class="collapsible-header truncate">
                <i class="material-icons">dashboard</i>
                <span class="hidden-1000">Dashboard</span>
            </div>
        </a>
    </li>

    {{-- Climbing gym --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">account_balance</i>
            <span class="hidden-1000">
                SAE
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('admin_sae_upload') }}">
                <div class="row truncate">
                    <i class="left material-icons">collections</i>
                    <span class="hidden-1000">
                        Logo &amp; Bandeau
                    </span>
                </div>
            </a>
            <a href="{{ route('add_gym_admin') }}">
                <div class="row truncate">
                    <i class="left material-icons">collections</i>
                    <span class="hidden-1000">
                        Ajouter un admin
                    </span>
                </div>
            </a>
            <div class="row truncate">
                <i class="left material-icons">delete</i>
                <span class="hidden-1000">
                    Supprimer une salle
                </span>
            </div>
        </div>
    </li>

    {{-- Routes --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">timeline</i>
            <span class="hidden-1000">
                Lignes
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('admin_route_information') }}">
                <div class="row truncate">
                    <i class="left material-icons">info</i>
                    <span class="hidden-1000">
                        Informations
                    </span>
                </div>
            </a>
        </div>
    </li>

    {{-- Sectors --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">perm_media</i>
            <span class="hidden-1000">
                Secteur
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('admin_sector_information') }}">
                <div class="row truncate">
                    <i class="left material-icons">info</i>
                    <span class="hidden-1000">
                        Informations
                    </span>
                </div>
            </a>
        </div>
    </li>

    {{-- Articles --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">art_track</i>
            <span class="hidden-1000">
                Articles
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('uploadBandeauArticlePage') }}">
                <div class="row truncate">
                    <i class="left material-icons">file_upload</i>
                    <span class="hidden-1000">
                        Uploader bandeau
                    </span>
                </div>
            </a>
            <a href="{{ route('createArticlePage') }}">
                <div class="row truncate">
                    <i class="left material-icons">add</i>
                    <span class="hidden-1000">
                        Créer un article
                    </span>
                </div>
            </a>
            <a href="{{ route('updateArticlePage') }}">
                <div class="row truncate">
                    <i class="left material-icons">create</i>
                    <span class="hidden-1000">
                        Modifier un article
                    </span>
                </div>
            </a>
        </div>
    </li>

    {{-- Helps --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">school</i>
            <span class="hidden-1000">
                Aides
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('createHelpPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">add</i>
                    <span class="hidden-1000">
                        Créer une aide
                    </span>
                </div>
            </a>
            <a href="{{ route('updateHelpPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">create</i>
                    <span class="hidden-1000">
                        Modifier une aide
                    </span>
                </div>
            </a>
            <a href="{{ route('deleteHelpPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">delete</i>
                    <span class="hidden-1000">
                        Supprimer une aide
                    </span>
                </div>
            </a>
        </div>
    </li>


    {{-- Exceptions --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">report_problem</i>
            <span class="hidden-1000">
                Exceptions
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('createExceptionPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">add</i>
                    <span class="hidden-1000">
                        Créer une exception
                    </span>
                </div>
            </a>
            <a href="{{ route('updateExceptionPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">create</i>
                    <span class="hidden-1000">
                        Modifier une exception
                    </span>
                </div>
            </a>
            <a href="{{ route('deleteExceptionPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">delete</i>
                    <span class="hidden-1000">
                        Supprimer une exception
                    </span>
                </div>
            </a>
        </div>
    </li>

    {{-- Newsletter --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">mail</i>
            <span class="hidden-1000">
                Newsletter
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('createNewsletterPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">add</i>
                    <span class="hidden-1000">
                        Créer une news letter
                    </span>
                </div>
            </a>
            <a href="{{ route('updateNewsletterPage') }}">
                <div class="row truncate">
                    <i class="left material-icons">create</i>
                    <span class="hidden-1000">
                        Modifier une news letter
                    </span>
                </div>
            </a>
        </div>
    </li>

</ul>




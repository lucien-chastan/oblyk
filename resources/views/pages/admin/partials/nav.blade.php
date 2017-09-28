
<ul class="collapsible" data-collapsible="accordion">

    {{--DASHBOARD--}}
    <li>
        <a href="{{ route('admin_home') }}">
            <div class="collapsible-header truncate">
                <i class="material-icons">dashboard</i>
                <span class="hidden-1000">Dashboard</span>
            </div>
        </a>
    </li>

    {{--SALLE D'ESCALADE--}}
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
            <div class="row truncate">
                <i class="left material-icons">delete</i>
                <span class="hidden-1000">
                    Supprimer une salle
                </span>
            </div>
        </div>
    </li>

    {{--LES VOIES--}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">timeline</i>
            <span class="hidden-1000">
                Lignes
            </span>
        </div>
        <div class="collapsible-body">
            <a href="{{ route('admin_sae_upload') }}">
                <div class="row truncate">
                    <i class="left material-icons">info</i>
                    <span class="hidden-1000">
                        Informations
                    </span>
                </div>
            </a>
        </div>
    </li>

</ul>




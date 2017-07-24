<div class="row">
    <div class="col s12">
        <div class="card-panel">
            <h2 class="loved-king-font">Filtrer mon analytiks</h2>

            <div class="row">

                <div class="col s12 l6">
                    <p class="text-underline">Filtre sur les types de grimpe :</p>
                    <p class="no-margin grey-text bt-action-filter">
                        <span onclick="cocheFiltre(true,'climbsFilter')">
                            <i class="material-icons">done_all</i> Tout cocher
                        </span>
                        <span onclick="cocheFiltre(false,'climbsFilter')">
                            <i class="material-icons">crop_square</i> Tout décocher
                        </span>
                    </p>
                    @foreach($climbs as $climb)
                        {!! $Inputs::checkbox(['name'=>'climbsFilter', 'value' => $climb->id, 'id'=> 'climb-filter-' . $climb->id, 'label'=>ucfirst($climb->label), 'checked' => ($filter_climb[$climb->id] == true) ? true : false, 'align' => 'left']) !!}
                    @endforeach
                </div>

                <div class="col s12 l6">
                    <p class="text-underline">Filtre sur les types d'enchainement :</p>
                    <p class="no-margin grey-text bt-action-filter">
                        <span onclick="cocheFiltre(true,'statusesFilter')">
                            <i class="material-icons">done_all</i> Tout cocher
                        </span>
                        <span onclick="cocheFiltre(false,'statusesFilter')">
                            <i class="material-icons">crop_square</i> Tout décocher
                        </span>
                    </p>
                    @foreach($statuses as $status)
                        {!! $Inputs::checkbox(['name'=>'statusesFilter', 'value' => $status->id, 'id'=>'status-filter-' . $status->id, 'label'=>ucfirst($status->label), 'checked' => ($filter_status[$status->id] == true) ? true : false, 'align' => 'left']) !!}
                    @endforeach
                </div>

                <div class="col s12">
                    <div class="switch switch-filter-period">
                        <span class="text-underline">Afficher mes croix uniquement entre deux dates : </span>
                        <label>
                            Non
                            @if($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now')
                                <input id="switch-filter" type="checkbox" checked onchange="visibleFilterPeriod(this)">
                            @else
                                <input id="switch-filter" type="checkbox" onchange="visibleFilterPeriod(this)">
                            @endif
                            <span class="lever"></span>
                            Oui
                        </label>
                    </div>
                    <div id="div-filter-period" class="row" style="{{ ($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now') ? '' : 'display: none' }}">
                        <div class="col s12 l6">
                            {!! $Inputs::date(['name'=>'filterStart', 'id'=> 'climb-filter-start', 'label'=>'Date de départ', 'value'=> ($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now') ? $filter_periods['start'] : date('Y-m-d')]) !!}
                        </div>
                        <div class="col s12 l6">
                            {!! $Inputs::date(['name'=>'filterEnd', 'id'=> 'climb-filter-end', 'label'=>'Date de fin', 'value'=> ($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now') ? $filter_periods['end'] : date('Y-m-d')]) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false, 'onclick' => 'submitFilter()']) !!}
            </div>
        </div>
    </div>
</div>
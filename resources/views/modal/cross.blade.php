@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">

        <div class="row">
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">playlist_add_check</i> Dans mon carnet</p>
            {!! $Inputs::crossStatuses(['name'=>'status_id','label'=>'Status (En projet, À vue, Flash, etc.)', 'value'=> $dataModal['status_id']]) !!}
            <div style="{{$dataModal['showMode']}}">
                {!! $Inputs::crossModes(['name'=>'mode_id','label'=>'Mode (En tête, en moulinette, etc.)', 'value'=> $dataModal['mode_id']]) !!}
            </div>
            {!! $Inputs::date(['name'=>'release_at', 'label'=>'Date de la croix', 'placeholder'=>'Date de la croix', 'value'=> $dataModal['release_at']]) !!}
            {!! $Inputs::text(['name'=>'attempt', 'label'=>'Nombre de tentative', 'value'=> $dataModal['attempt'], 'type'=>'number']) !!}
        </div>

        <div class="row" style="{{$dataModal['showPitchs']}}">
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">timeline</i> Les longueurs que j'ai faite</p>
            <div id="list-pitch-cross-popup">
                <table class="striped bordered centered table-pitch-cross">
                    <thead>
                    <tr>
                        <th>Faite</th>
                        <th>Longueur</th>
                        <th>Cotation</th>
                        <th>Hauteur</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataModal['line']->routeSections as $section)
                        <tr>
                            <td>{!! $Inputs::checkbox(['name'=>'crossPopupPitch', 'value'=>$section->id , 'id'=>'cross-pitch-' . $section->id , 'label'=>'', 'checked'=> in_array($section->id, $dataModal['crossPitchs']), 'align'=>'center', 'onchange'=>'parsePitch()']) !!}</td>
                            <td>L {{ $section->section_order }}</td>
                            <td><span class="color-grade-{{ $section->grade_val }}">{{ $section->grade }}{{ $section->sub_grade }}</span></td>
                            <td>{{ $section->section_height }} m</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $Inputs::Hidden(['name'=>'crossPitchs','value'=>implode(';', $dataModal['crossPitchs']), 'id'=>'crossPitchs']) !!}

            </div>
        </div>

        <div class="row">
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">star</i> Comment j'ai trouvé cette voie</p>
            {!! $Inputs::crossHardnesses(['name'=>'hardness_id', 'label'=>'L\'as tu trouvé dur pour la cotation ?', 'value'=> $dataModal['hardness_id']]) !!}
            {!! $Inputs::note(['name'=>'note', 'label'=>'Commment noterais-tu cette ligne ?', 'value'=> $dataModal['crossNote']]) !!}
            {!! $Inputs::mdText(['name'=>'description', 'label'=>'Commentaire', 'value'=> $dataModal['crossDescription']]) !!}
        </div>

        <div class="row" style="display: none">
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">info_outline</i> Aide oblyk à mieux connaître cette voie !</p>
        </div>

        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}

    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'route_id','value'=>$dataModal['route_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'environment','value'=>0]) !!}
</form>

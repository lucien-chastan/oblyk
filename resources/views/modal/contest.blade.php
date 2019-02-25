@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['contest']->label, 'label'=>'Titre du contest', 'type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['contest']->description, 'label'=>'Description']) !!}

        {{-- Start Date --}}
        {!! $Inputs::date(['name'=>'start_date', 'value'=>$dataModal['contest']->start_date, 'label'=>'Date de début', 'col'=> 's8']) !!}
        {!! $Inputs::hour(['name'=>'start_hour', 'value'=>$dataModal['contest']->start_hour, 'label'=>'Heure', 'col'=> 's2']) !!}
        {!! $Inputs::minute(['name'=>'start_minute', 'value'=>$dataModal['contest']->start_minute, 'label'=>'Minute', 'col'=> 's2']) !!}

        {{-- End date --}}
        {!! $Inputs::date(['name'=>'end_date', 'value'=>$dataModal['contest']->end_date, 'label'=>'Date de fin', 'col'=> 's8']) !!}
        {!! $Inputs::hour(['name'=>'end_hour', 'value'=>$dataModal['contest']->end_hour, 'label'=>'Heure', 'col'=> 's2']) !!}
        {!! $Inputs::minute(['name'=>'end_minute', 'value'=>$dataModal['contest']->end_minute, 'label'=>'Minute', 'col'=> 's2']) !!}

        {{-- Participant limit --}}
        {!! $Inputs::text(['name'=>'participant_limit', 'value'=>$dataModal['contest']->participant_limit, 'label'=>'Nombre maximum de participant (O ou vide pour ilimité)', 'type'=>'number']) !!}

        {{-- Hours after end --}}
        {!! $Inputs::text(['name'=>'minutes_after_end', 'value'=>$dataModal['contest']->minutes_after_end, 'label'=>"Pendant combien de minute après la fin du contest vous autorisez les participants à noter leur bloc ", 'type'=>'number']) !!}

        {{-- Options --}}
        <p class="text-underline">Options :</p>
        {!! $Inputs::checkbox(['name'=>'real_time_result', 'checked'=>($dataModal['contest']->real_time_result == 1), 'label'=>'Le classement est affiché un temps réel']) !!}
        {!! $Inputs::checkbox(['name'=>'hide_route_before_contest', 'checked'=>($dataModal['contest']->hide_route_before_contest == 1), 'label'=>'Cacher les lignes sur le topo avant le départ du contest']) !!}
        {!! $Inputs::checkbox(['name'=>'subscribers_need_validation', 'checked'=>($dataModal['contest']->subscribers_need_validation == 1), 'label'=>"Les grimpeurs peuvent participer uniquement après votre validation"]) !!}

        {{-- Validation message --}}
        {!! $Inputs::text(['name'=>'validation_message', 'value'=>$dataModal['contest']->validation_message, 'label'=>'Message à afficher si vous exiger une validation', 'type'=>'text']) !!}


        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
</form>

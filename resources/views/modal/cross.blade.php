@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">

        <div class="row">
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">playlist_add_check</i> @lang('modals/cross.sendListTitle')</p>
            {!! $Inputs::crossStatuses(['name'=>'status_id','label'=>trans('modals/cross.status'), 'value'=> $dataModal['status_id']]) !!}
            <div style="{{$dataModal['showMode']}}">
                {!! $Inputs::crossModes(['name'=>'mode_id','label'=>trans('modals/cross.mode'), 'value'=> $dataModal['mode_id']]) !!}
            </div>
            {!! $Inputs::date(['name'=>'release_at', 'label'=>trans('modals/cross.crossDate'), 'placeholder'=>trans('modals/cross.crossDate'), 'value'=> $dataModal['release_at']]) !!}
            {!! $Inputs::text(['name'=>'attempt', 'label'=>trans('modals/cross.attempt'), 'value'=> $dataModal['attempt'], 'type'=>'number']) !!}
        </div>

        <div class="row" style="{{$dataModal['showPitchs']}}">
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">timeline</i> @lang('modals/cross.pitchTitle')</p>
            <div id="list-pitch-cross-popup">
                <table class="striped bordered centered table-pitch-cross">
                    <thead>
                    <tr>
                        <th>@lang('modals/cross.activeColumn')</th>
                        <th>@lang('modals/cross.pitchColumn')</th>
                        <th>@lang('modals/cross.gradeColumn')</th>
                        <th>@lang('modals/cross.heightColumn')</th>
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
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">star</i> @lang('modals/cross.evaluationTitle')</p>
            {!! $Inputs::crossHardnesses(['name'=>'hardness_id', 'label'=>trans('modals/cross.hardnessQuestion'), 'value'=> $dataModal['hardness_id']]) !!}
            {!! $Inputs::note(['name'=>'note', 'label'=>trans('modals/cross.noteQuestion'), 'value'=> $dataModal['crossNote']]) !!}
            {!! $Inputs::mdText(['name'=>'description', 'label'=>trans('modals/cross.comment'), 'value'=> $dataModal['crossDescription']]) !!}
            {!! $Inputs::checkbox(['name'=>'private', 'id'=>'check-private' , 'label'=>trans('modals/cross.private_comment'), 'checked'=> ($dataModal['crossPrivate'] == 1) ? 'true' : 'false', 'align'=>'right']) !!}
        </div>

        <div class="row" style="display: none">
            <p class="cross-hr-section grey-text"><i class="material-icons tiny left">info_outline</i> @lang('modals/cross.informationTitle')</p>
        </div>

        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}

    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'route_id','value'=>$dataModal['route_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'environment','value'=>0]) !!}
</form>

@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>'Supprimer un élément']) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'DELETE']) !!}

    <div class="row">
        <p class="text-center">
            @lang('modals/delete.deleteQuestion')<br>
            <span class="grey-text">(@lang('modals/delete.noReturn')</span>
        </p>
    </div>

    <div class="row">
        {!! $Inputs::Submit(['label'=>trans('modals/delete.delete'), 'color'=>'red']) !!}
    </div>
</form>

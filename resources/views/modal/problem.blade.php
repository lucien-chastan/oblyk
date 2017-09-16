@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>'Signaler un problème']) !!}

<form class="submit-form" data-route="{{ route('sendProblem') }}" onsubmit="submitData(this, closeProblemModal); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        <div class="col s12">
            <p>
                @lang('modals/problem.intro')
            </p>
        </div>
    </div>

    <div class="row">
        {!! $Inputs::text(['name'=>'email', 'value'=>$dataModal['email'], 'label'=>trans('modals/problem.email'), 'placeholder'=>trans('modals/problem.emailPlaceholder'),'type'=>'email']) !!}
        {!! $Inputs::mdText(['name'=>'problem', 'value'=>'', 'label'=>trans('modals/problem.problem'), 'placeholder'=>trans('modals/problem.problemPlaceholder')]) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'model','value'=>$dataModal['model']]) !!}
    {!! $Inputs::Hidden(['name'=>'page','value'=>'', 'id'=>'inputCurrentPage']) !!}
</form>

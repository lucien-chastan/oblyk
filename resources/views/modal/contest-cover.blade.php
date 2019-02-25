@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" onsubmit="uploadContestCover(this, {{ $dataModal['callback'] }}, {{ $dataModal['gym_id'] }}, {{ $dataModal['contest_id'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        <p>Préférez une image au format paysage</p>
        {!! $Inputs::upload(['name'=>'scheme', 'filter'=>'image/*', 'id'=>'upload-input-contest-cover' ,'label'=>'Couverture']) !!}
        {!! $Inputs::progressbar(['id'=>'progressbar-upload-contest-cover']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['contest_id']]) !!}
</form>

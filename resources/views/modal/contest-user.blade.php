@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        @if($dataModal['contest']->hasValidationMessage())
            <p class="text-center">
                {{ $dataModal['contest']->validation_message }}
            </p>
        @endif

        @if($dataModal['showMoreInfo'])
            <p class="text-underline">Merci de compléter ces informations pour vous inscrire</p>

            @if(!$dataModal['user']->hasFirstName())
                {!! $Inputs::text(['name'=>'first_name', 'value'=>$dataModal['user']->first_name, 'label'=>trans('pages/profile/settings.labelFirstName'), 'type'=>'text']) !!}
            @endif

            @if(!$dataModal['user']->hasLastName())
                {!! $Inputs::text(['name'=>'last_name', 'value'=>$dataModal['user']->last_name, 'label'=>trans('pages/profile/settings.labelLastName'), 'type'=>'text']) !!}
            @endif

            @if(!$dataModal['user']->hasCoherentAge())
                {!! $Inputs::text(['name'=>'birth', 'value'=>$dataModal['user']->birth, 'label'=>trans('pages/profile/settings.labelBirthYear'), 'type'=>'number']) !!}
            @endif

            @if(!$dataModal['user']->sexIsDefined())
                {!! $Inputs::sex(['name'=>'sex', 'value'=>$dataModal['user']->sex, 'label'=>trans('pages/profile/settings.labelSex')]) !!}
            @endif
        @endif

        <p class="grey-text text-center">En vous inscrivant vous vous engagez à ne pas tricher sur les blocs que vous faite</p>

        @if($dataModal['contest']->subscribersNeedToBeValidated())
            {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.sign_up_for_subscription')]) !!}
        @else
            {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.subscribe')]) !!}
        @endif
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'user_id','value'=>$dataModal['user_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'contest_id','value'=>$dataModal['contest_id']]) !!}
</form>

@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym']->label, 'label'=>trans('modals/gym.name'), 'placeholder'=>trans('modals/gym.namePlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'city', 'value'=>$dataModal['gym']->city, 'label'=>trans('modals/gym.city'), 'placeholder'=>trans('modals/gym.cityPlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'big_city', 'value'=>$dataModal['gym']->big_city, 'label'=>trans('modals/gym.bigCity'), 'placeholder'=>trans('modals/gym.bigCityPlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'address', 'value'=>$dataModal['gym']->address, 'label'=>trans('modals/gym.address'), 'placeholder'=>trans('modals/gym.addressPlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'postal_code', 'value'=>$dataModal['gym']->postal_code, 'label'=>trans('modals/gym.postalCode'), 'placeholder'=>trans('modals/gym.postalCodePlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'region', 'value'=>$dataModal['gym']->region, 'label'=>trans('modals/gym.county'), 'placeholder'=>trans('modals/gym.countyPlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::checkbox(['name'=>'type_boulder', 'checked'=>($dataModal['gym']->type_boulder == 1), 'label'=>trans('modals/gym.boulder')]) !!}
        {!! $Inputs::checkbox(['name'=>'type_route', 'checked'=>($dataModal['gym']->type_route == 1), 'label'=>trans('modals/gym.route')]) !!}
        {!! $Inputs::text(['name'=>'phone_number', 'value'=>$dataModal['gym']->phone_number, 'label'=>trans('modals/gym.phoneNumber'), 'placeholder'=>trans('modals/gym.phoneNumberPlaceholder'),'type'=>'tel']) !!}
        {!! $Inputs::text(['name'=>'email', 'value'=>$dataModal['gym']->email, 'label'=>trans('modals/gym.email'), 'placeholder'=>trans('modals/gym.emailPlaceholder'),'type'=>'email']) !!}
        {!! $Inputs::text(['name'=>'web_site', 'value'=>$dataModal['gym']->web_site, 'label'=>trans('modals/gym.website'), 'placeholder'=>trans('modals/gym.websitePlaceholder'),'type'=>'url']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['gym']->description, 'label'=>trans('modals/gym.description')]) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['gym']->lat, 'lng'=>$dataModal['gym']->lng, 'label'=>trans('modals/gym.localisation')]) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['gym']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'code_country','value'=>$dataModal['gym']->code_country]) !!}
    {!! $Inputs::Hidden(['name'=>'country','value'=>$dataModal['gym']->country]) !!}
</form>

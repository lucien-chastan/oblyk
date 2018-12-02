@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <form id="form-compte-setting" class="submit-form row" data-route="/gyms/{{$gym->id}}" onsubmit="submitData(this, reloadCurrentVue); return false">

                    <h2 class="loved-king-font" style="font-size: 2em;">@lang('pages/profile/settings.titleInformation')</h2>

                    {!! $Inputs::popupError() !!}

                    {!! $Inputs::text(['name'=>'label', 'value'=>$gym->label, 'label'=>trans('modals/gym.name'), 'placeholder'=>trans('modals/gym.namePlaceholder'),'type'=>'text']) !!}
                    {!! $Inputs::text(['name'=>'city', 'value'=>$gym->city, 'label'=>trans('modals/gym.city'), 'placeholder'=>trans('modals/gym.cityPlaceholder'),'type'=>'text']) !!}
                    {!! $Inputs::text(['name'=>'big_city', 'value'=>$gym->big_city, 'label'=>trans('modals/gym.bigCity'), 'placeholder'=>trans('modals/gym.bigCityPlaceholder'),'type'=>'text']) !!}
                    {!! $Inputs::text(['name'=>'address', 'value'=>$gym->address, 'label'=>trans('modals/gym.address'), 'placeholder'=>trans('modals/gym.addressPlaceholder'),'type'=>'text']) !!}
                    {!! $Inputs::text(['name'=>'postal_code', 'value'=>$gym->postal_code, 'label'=>trans('modals/gym.postalCode'), 'placeholder'=>trans('modals/gym.postalCodePlaceholder'),'type'=>'text']) !!}
                    {!! $Inputs::text(['name'=>'region', 'value'=>$gym->region, 'label'=>trans('modals/gym.county'), 'placeholder'=>trans('modals/gym.countyPlaceholder'),'type'=>'text']) !!}
                    {!! $Inputs::checkbox(['name'=>'type_boulder', 'checked'=>($gym->type_boulder == 1), 'label'=>trans('modals/gym.boulder')]) !!}
                    {!! $Inputs::checkbox(['name'=>'type_route', 'checked'=>($gym->type_route == 1), 'label'=>trans('modals/gym.route')]) !!}
                    {!! $Inputs::text(['name'=>'phone_number', 'value'=>$gym->phone_number, 'label'=>trans('modals/gym.phoneNumber'), 'placeholder'=>trans('modals/gym.phoneNumberPlaceholder'),'type'=>'tel']) !!}
                    {!! $Inputs::text(['name'=>'email', 'value'=>$gym->email, 'label'=>trans('modals/gym.email'), 'placeholder'=>trans('modals/gym.emailPlaceholder'),'type'=>'email']) !!}
                    {!! $Inputs::text(['name'=>'web_site', 'value'=>$gym->web_site, 'label'=>trans('modals/gym.website'), 'placeholder'=>trans('modals/gym.websitePlaceholder'),'type'=>'url']) !!}
                    {!! $Inputs::mdText(['name'=>'description', 'value'=>$gym->description, 'label'=>trans('modals/gym.description')]) !!}
                    {!! $Inputs::localisation(['lat'=>$gym->lat, 'lng'=>$gym->lng, 'label'=>trans('modals/gym.localisation')]) !!}

                    {!! $Inputs::Hidden(['name'=>'_method','value'=>'PUT']) !!}
                    {!! $Inputs::Hidden(['name'=>'country','value'=>$gym->country]) !!}
                    {!! $Inputs::Hidden(['name'=>'id','value'=>$gym->id]) !!}

                    <div class="row">
                        {!! $Inputs::Submit(['label'=>trans('pages/profile/settings.saveSubmit'), 'cancelable' => false]) !!}
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

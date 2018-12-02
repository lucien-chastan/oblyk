@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form">

    {!! $Inputs::popupError() !!}

    <div class="row">

        {{--LISTE DES TOPOS--}}
        <div id="zone-massive-est-il-present">

            <p class="text-underline text-bold">@lang('modals/massive.connectionTitle')</p>

            <div id="liste-massive-proche" style="display: none">
                @lang('modals/massive.groupList')
            </div>
        </div>


        {{--VALIDATION--}}
        <div id="validation-liaison-massive" class="bt-validation-topo-proche" style="display: none">

            <p class="text-center text-underline text-bold"><span id="nom-site-liaison">xxx</span> @lang('modals/massive.connected') : <span id="nom-massive-liaison">xxx</span></p>

            {!! $Inputs::Hidden(['name'=>'id', 'id'=>'id-new-liaison', 'value'=>'']) !!}

            <div class="row">
                <div class="col s6"><a id="lien-vers-massive" class="btn waves-effect">@lang('modals/massive.seeGroup')</a></div>
                <div class="col s6"><a onclick="getMassiveArround()" class="btn waves-effect">@lang('modals/massive.otherGroup')</a></div>
            </div>
            <div class="row">
                <div class="col s6"><a class="btn-flat waves-effect" onclick="closeModal();refresh();">@lang('modals/massive.close')</a></div>
                <div class="col s6"><a class="btn-flat waves-effect" onclick="deleteMassiveLiaison()">@lang('modals/massive.cancel')</a></div>
            </div>
        </div>


        {{--LOADER--}}
        <div class="text-center" id="loader-liste-massive">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>


        {{--ZONE CRÉER UN NOUVEAU TOPO--}}
        <div id="zone-creer-un-nouveau-massive">
            <p class="text-underline text-bold">@lang('modals/massive.createTitle')</p>

            <p class="text-right">
                <a class="btn-flat waves-effect" onclick="closeModal()">@lang('modals/massive.cancel')</a>
                <a onclick="openModal('/modal/massive', {title : '@lang('modals/massive.newGroup')', massive_id : '', method : 'POST', crag_id : {{$dataModal['crag_id']}}, callback : 'goToNewMassive'})" class="btn waves-effect">@lang('modals/massive.addANewGroup')</a>
            </p>
        </div>

    </div>

    {!! $Inputs::Hidden(['name'=>'crag_id', 'id'=>'id-search-massive', 'value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'lat', 'id'=>'lat-search-massive', 'value'=>$dataModal['lat']]) !!}
    {!! $Inputs::Hidden(['name'=>'lng', 'id'=>'lng-search-massive','value'=>$dataModal['lng']]) !!}
    {!! $Inputs::Hidden(['name'=>'rayon', 'id'=>'rayon-search-massive','value'=>$dataModal['rayon']]) !!}
</form>

@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<ul class="topotabs tabs tabs-fixed-width">
    <li class="tab"><a class="active" href="#tab_0">@lang('modals/paperGuideBook.searchByProximity')</a></li>
    <li class="tab"><a href="#tab_1">@lang('modals/paperGuideBook.searchByName')</a></li>
</ul>
<form class="submit-form">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        <div id="tab_0" class="col s12"> 

            {{--LISTE DES TOPOS--}}
            <div id="zone-topo-est-il-present">

                <p class="text-underline text-bold">@lang('modals/paperGuideBook.tileConnection')</p> 

                <div id="liste-topo-proche" style="display: none">
                    @lang('modals/paperGuideBook.guidebookList')

                </div>
            </div>

            {{--VALIDATION--}}
            <div id="validation-liaison-topo" class="bt-validation-topo-proche" style="display: none">

                <p class="text-center text-underline text-bold"><span id="nom-site-liaison">xxx</span> @lang('modals/paperGuideBook.connectedGuidebook') : <span id="nom-topo-liaison">xxx</span></p>

                {!! $Inputs::Hidden(['name'=>'id', 'id'=>'id-new-liaison', 'value'=>'']) !!}

                <div class="row">
                    <div class="col s6"><a id="lien-vers-topo" class="btn waves-effect">@lang('modals/paperGuideBook.seeGuidebook')</a></div>
                    <div class="col s6"><a onclick="getTopoArround()" class="btn waves-effect">@lang('modals/paperGuideBook.connectGuidebook')</a></div>
                </div>
                <div class="row">
                    <div class="col s6"><a class="btn-flat waves-effect" onclick="closeModal();refresh();">@lang('modals/paperGuideBook.close')</a></div>
                    <div class="col s6"><a class="btn-flat waves-effect" onclick="deleteLiaison()">@lang('modals/paperGuideBook.cancel')</a></div>
                </div>
            </div>
        </div>
        <div id="tab_1" class="col s12"> 
            <input onkeyup="getTopoByName()" type="text" placeholder="@lang('modals/paperGuideBook.searchByName')" id="name-search-topo" />
            {{--LISTE DES TOPOS--}}
            <div id="zone-topo-est-il-present-byname">

                <p class="text-underline text-bold">@lang('modals/paperGuideBook.tileConnection')</p> 

                <div id="liste-topo-proche-byname" style="display: none">
                    @lang('modals/paperGuideBook.guidebookList')
                </div>
            </div>
            {{--VALIDATION--}}
            <div id="validation-liaison-topo-byname" class="bt-validation-topo-proche" style="display: none">

                <p class="text-center text-underline text-bold"><span id="nom-site-liaison">xxx</span> @lang('modals/paperGuideBook.connectedGuidebook') : <span id="nom-topo-liaison">xxx</span></p>

                {!! $Inputs::Hidden(['name'=>'id', 'id'=>'id-new-liaison', 'value'=>'']) !!}

                <div class="row">
                    <div class="col s6"><a id="lien-vers-topo" class="btn waves-effect">@lang('modals/paperGuideBook.seeGuidebook')</a></div>
                </div>
                <div class="row">
                    <div class="col s6"><a class="btn-flat waves-effect" onclick="closeModal();refresh();">@lang('modals/paperGuideBook.close')</a></div>
                    <div class="col s6"><a class="btn-flat waves-effect" onclick="deleteLiaison()">@lang('modals/paperGuideBook.cancel')</a></div>
                </div>
            </div>
        </div>
        {{--LOADER--}}
        <div class="text-center" id="loader-liste-topo" style="display:none">
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
        <div id="zone-creer-un-nouveau-topo">
            <p class="text-underline text-bold">@lang('modals/paperGuideBook.titleNewGuidebook')</p>

            <p class="text-right">
                <a class="btn-flat waves-effect" onclick="closeModal()">@lang('modals/paperGuideBook.cancel')</a>
                <a onclick="openModal('/modal/topo', {title : '@lang('modals/paperGuideBook.newGuidebookTitle')', topo_id : '', method : 'POST', crag_id : {{$dataModal['crag_id']}}, callback : 'goToNewTopo'})" class="btn waves-effect">@lang('modals/paperGuideBook.newGuidebookBtn')</a>
            </p>
        </div>

    </div>

    {!! $Inputs::Hidden(['name'=>'crag_id', 'id'=>'id-search-topo', 'value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'lat', 'id'=>'lat-search-topo', 'value'=>$dataModal['lat']]) !!}
    {!! $Inputs::Hidden(['name'=>'lng', 'id'=>'lng-search-topo','value'=>$dataModal['lng']]) !!}
    {!! $Inputs::Hidden(['name'=>'rayon', 'id'=>'rayon-search-topo','value'=>$dataModal['rayon']]) !!}
</form>

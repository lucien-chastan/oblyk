@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form">

    {!! $Inputs::popupError([]) !!}

    <div class="row">

        {{--LISTE DES TOPOS--}}
        <div id="zone-massive-est-il-present">

            <p class="text-underline text-bold">Ce site est-il présent dans l'un de ces groupes ?</p>

            <div id="liste-massive-proche" style="display: none">
                liste des groupes
            </div>
        </div>


        {{--VALIDATION--}}
        <div id="validation-liaison-massive" class="bt-validation-topo-proche" style="display: none">

            <p class="text-center text-underline text-bold"><span id="nom-site-liaison">xxx</span> à été lié avec le groupe : <span id="nom-massive-liaison">xxx</span></p>

            {!! $Inputs::Hidden(['name'=>'id', 'id'=>'id-new-liaison', 'value'=>'']) !!}

            <div class="row">
                <div class="col s6"><a id="lien-vers-massive" class="btn waves-effect">voir le groupe</a></div>
                <div class="col s6"><a onclick="getMassiveArround()" class="btn waves-effect">Lier ce site à un autre groupe</a></div>
            </div>
            <div class="row">
                <div class="col s6"><a class="btn-flat waves-effect" onclick="closeModal();refresh();">Fermer</a></div>
                <div class="col s6"><a class="btn-flat waves-effect" onclick="deleteMassiveLiaison()">Annuler la liaison</a></div>
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
            <p class="text-underline text-bold">Si votre groupe n'est pas dans la liste ci-dessus vous pouvez créer un nouveau groupe</p>

            <p class="text-right">
                <a class="btn-flat waves-effect" onclick="closeModal()">Annuler</a>
                <a onclick="openModal('/modal/massive', {title : 'Nouveau groupement', massive_id : '', method : 'POST', crag_id : {{$dataModal['crag_id']}}, callback : 'goToNewMassive'})" class="btn waves-effect">Créer un nouveau groupe</a>
            </p>
        </div>

    </div>

    {!! $Inputs::Hidden(['name'=>'crag_id', 'id'=>'id-search-massive', 'value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'lat', 'id'=>'lat-search-massive', 'value'=>$dataModal['lat']]) !!}
    {!! $Inputs::Hidden(['name'=>'lng', 'id'=>'lng-search-massive','value'=>$dataModal['lng']]) !!}
    {!! $Inputs::Hidden(['name'=>'rayon', 'id'=>'rayon-search-massive','value'=>$dataModal['rayon']]) !!}
</form>

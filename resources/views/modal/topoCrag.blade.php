@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form">

    <div class="row">

        <p class="text-underline text-bold">Ce site est-il présent dans l'un de ces topos ?</p>

        <div id="liste-topo-proche" style="display: none">
            liste des topos
        </div>
        <div class="text-center" id="loader-liste-topo">
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

        <p class="text-underline text-bold">Si votre topo n'est pas dans la liste ci-dessous vous pouvez créer un nouveau topo</p>

        <p class="text-right">
            <a class="btn-flat waves-effect" onclick="closeModal()">Annuler</a>
            <a class="btn waves-effect">Créer un nouveau topo</a>
        </p>
    </div>

    {!! $Inputs::Hidden(['name'=>'crag_id', 'id'=>'id-search-topo', 'value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'lat', 'id'=>'lat-search-topo', 'value'=>$dataModal['lat']]) !!}
    {!! $Inputs::Hidden(['name'=>'lng', 'id'=>'lng-search-topo','value'=>$dataModal['lng']]) !!}
    {!! $Inputs::Hidden(['name'=>'rayon', 'id'=>'rayon-search-topo','value'=>$dataModal['rayon']]) !!}
</form>

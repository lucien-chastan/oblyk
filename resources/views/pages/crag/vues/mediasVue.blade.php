@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            <h2 class="loved-king-font text-center">Photos &amp; Vidéos</h2>

            {{--bouton d'ajout--}}
            @if(Auth::check())
                <div class="fixed-action-btn horizontal">
                    <a class="btn-floating btn-large red">
                        <i class="large material-icons">add</i>
                    </a>
                    <ul>
                        <li><a {!! $Helpers::tooltip('Ajouter une photo') !!} class="tooltipped btn-floating blue"><i class="material-icons">photo_camera</i></a></li>
                        <li><a {!! $Helpers::tooltip('Ajouter une vidéo') !!} class="tooltipped btn-floating blue"><i class="material-icons">videocam</i></a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
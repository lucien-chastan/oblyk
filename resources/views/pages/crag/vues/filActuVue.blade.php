@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            <h2 class="loved-king-font text-center">Fil d'actualité du site</h2>

        </div>
    </div>
</div>

{{--bouton d'ajout--}}
@if(Auth::check())
    <div class="fixed-action-btn horizontal">
        <a {!! $Helpers::tooltip('Écrire dans le flux') !!} class="btn-floating btn-large red tooltipped">
            <i class="large material-icons">edit</i>
        </a>
    </div>
@endif

@inject('Helpers','App\Lib\HelpersTemplates')

<table class="striped responsive-table">
    <tr>
        <th>Note</th>
        <th>Cote</th>
        <th>Nom</th>
        <th>Type</th>
        <th>Hauteur</th>
        <th>Année</th>
        <th>Ouvreur</th>
    </tr>
@foreach($routes as $route)

    <tr data-activates="slide-route" class="button-open-route">
        <td><img {!! $Helpers::tooltip('Évaluation sur ' . $route->nb_note . ' note(s)') !!} src="/img/note_{{$route->note}}.png" alt="" class="tooltipped img-note-route-sector"></td>
        <td>
            @if(count($route->routeSections) > 1)
                {!! count($route->routeSections) !!} L.
            @else
                <span class="color-grade-{{$route->routeSections[0]->grade_val}}">{{$route->routeSections[0]->grade}}{{$route->routeSections[0]->sub_grade}}</span>
            @endif
        </td>
        <td>{{$route->label}}</td>
        <td><img src="/img/climb-{{$route->climb_id}}.png" alt="" class="type-ligne"> {{$route->climb->label}}</td>
        <td>
            @if(count($route->routeSections) == 1 && $route->height >= 35)
                <i {!! $Helpers::tooltip('Attention voie de plus de 35 mètres') !!} class="tooltipped material-icons red-text left">report_problem</i>
            @endif
            {{$route->height}} mètres
        </td>
        <td>{{$route->open_year}}</td>
        <td>{{$route->opener}}</td>
    </tr>

@endforeach
</table>

{{--BOUTON POUR AJOUTER UN LIGNE--}}
@if(Auth::check())
    <div class="row">
        <div class="text-right col s12">
            <a {!! $Helpers::tooltip('Ajouter une voie') !!} class="btn-floating btn waves-effect waves-light tooltipped"><i class="material-icons">add</i></a>
        </div>
    </div>
@endif
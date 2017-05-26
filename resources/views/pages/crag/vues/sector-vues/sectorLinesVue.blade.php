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

    <tr>
        <td><img {!! $Helpers::tooltip('Évaluation sur ' . $route->nb_note . ' note(s)') !!} src="/img/note_{{$route->note}}.png" alt="" class="tooltipped img-note-route-sector"></td>
        <td>
            @if(count($route->routeSections) > 1)
                {!! count($route->routeSections) !!} L.
            @else
                {{$route->routeSections[0]->grade}}{{$route->routeSections[0]->sub_grade}}
            @endif
        </td>
        <td>{{$route->label}}</td>
        <td>{{$route->climb_id}}</td>
        <td>{{$route->height}} mètres</td>
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
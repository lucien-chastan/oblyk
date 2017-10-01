
{{--INFORMATION BRUTE SUR LA LIGNE--}}
<h5 onclick="collapseArea('route-information-area', this)"><span>-</span> Information sur la ligne</h5>
<div id="route-information-area">
    <table class="property-table bordered striped">
        <thead>
        <tr>
            <th width="100">Propriété</th>
            <th>Caractéristique</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="property-column">Nom : </td>
            <td><a href="{{ route('routePage', ['route_id'=>$route->id,'route_label'=>str_slug($route->label)]) }}">{{ $route->label }}</a></td>
        </tr>
        <tr>
            <td class="property-column">Id : </td>
            <td>{{ $route->id }}</td>
        </tr>
        <tr>
            <td class="property-column">Site : </td>
            <td>
                id : {{ $route->crag_id }}<br>
                nom : <a href="{{ route('cragPage', ['crag_id'=>$route->crag_id, 'crag_label'=>str_slug($route->crag->label)]) }}">{{ $route->crag->label }}</a>
            </td>
        </tr>
        <tr>
            <td class="property-column">Secteur : </td>
            <td>
                id : {{ $route->sector_id }}<br>
                nom : {{ $route->sector->label }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Grimpeur : </td>
            <td>
                id : {{ $route->user_id }}<br>
                nom : <a href="{{ route('userPage', ['user_id'=>$route->user_id, 'user_label'=>str_slug($route->user->name)]) }}">{{ $route->user->name }}</a>
            </td>
        </tr>
        <tr>
            <td class="property-column">Type de grimpe : </td>
            <td>
                @lang('elements/climbs.climb_' . $route->climb_id)
            </td>
        </tr>
        <tr>
            <td class="property-column">Hauteur : </td>
            <td>
                {{ $route->height }} mètres
            </td>
        </tr>
        <tr>
            <td class="property-column">Ouverture : </td>
            <td>
                {{ $route->open_year }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Ouvreur : </td>
            <td>
                {{ $route->opener }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Note : </td>
            <td>
                ({{ $route->note }}) <img src="/img/note_{{ $route->note }}.png" height="12"><br>
                sur {{ $route->nb_note }} évaluation(s)
            </td>
        </tr>
        <tr>
            <td class="property-column">Longueur : </td>
            <td>
                {{ $route->nb_longueur }} longueurs<br>
                <ul>
                    @foreach($route->routeSections as $section)
                        <li>
                            <span class="color-grade-{{$section->grade_val}}">{{$section->grade . $section->sub_grade}}</span>,
                            {{ $section->section_height }} m,
                            {{ $section->nb_point }} @lang('elements/points.point_' . $section->point_id),
                            Re. @lang('elements/anchors.anchor_' . $section->anchor_id),
                            In. @lang('elements/inclines.incline_' . $section->incline_id),
                            Rc. @lang('elements/receptions.reception_' . $section->reception_id),
                            St. @lang('elements/starts.start_' . $section->start_id),
                            Od. {{ $section->section_order }}
                        </li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td class="property-column">Vue : </td>
            <td>
                {{ $route->views }} vues
            </td>
        </tr>
        <tr>
            <td class="property-column">Tags : </td>
            <td>
                @foreach($route->tags as $tag)
                    <span>#@lang('elements/tags.tag_' . $tag->tag_id) (<a href="{{ route('userPage', ['user_id'=>$tag->user->id, 'user_label'=>str_slug($tag->user->name)]) }}"><i class="material-icons tiny">account_circle</i></a>)</span>
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="property-column">Supprimé le : </td>
            <td>
                {{ $route->deleted_at }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Créé le : </td>
            <td>
                {{ $route->created_at }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Modifié le : </td>
            <td>
                {{ $route->updated_at }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Action : </td>
            <td>
                <a href="{{ route('delete_route', ['route_id'=>$route->id]) }}">supprimer</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>


{{--Croix associée--}}
<h5 onclick="collapseArea('route-crosses-area', this)"><span>-</span> Croix liées</h5>
<div id="route-crosses-area">
    @foreach($route->crosses as $cross)
        <p>croix : {{ $cross->created_at }} par <a href="{{ route('userPage', ['user_id'=>$cross->user->id, 'user_label'=>str_slug($cross->user->name)]) }}">{{ $cross->user->name }}</a></p>
    @endforeach
</div>

{{--TickList associée--}}
<h5 onclick="collapseArea('route-tickList-area', this)"><span>-</span> Ticks liés</h5>
<div id="route-tickList-area">
    @foreach($route->tickLists as $tick)
        <p>tick : {{ $tick->created_at }} par <a href="{{ route('userPage', ['user_id'=>$tick->user->id, 'user_label'=>str_slug($tick->user->name)]) }}">{{ $tick->user->name }}</a> (supprimer)</p>
    @endforeach
</div>

{{--Descriptions--}}
<h5 onclick="collapseArea('route-descriptions-area', this)"><span>-</span> Descriptions</h5>
<div id="route-descriptions-area">
    @foreach($route->descriptions as $description)
        <p>
            {{ $description->description }}<br>
            par : <a href="{{ route('userPage', ['user_id'=>$description->user->id, 'user_label'=>str_slug($description->user->name)]) }}">{{ $description->user->name }}</a>
        </p>
    @endforeach
</div>

{{--Video--}}
<h5 onclick="collapseArea('route-video-area', this)"><span>-</span> Vidéos</h5>
<div id="route-video-area">
    @foreach($route->videos as $video)
        <p>
            <a href="{{ $video->iframe }}">{{ $video->iframe }}</a><br>
            par : <a href="{{ route('userPage', ['user_id'=>$video->user->id, 'user_label'=>str_slug($video->user->name)]) }}">{{ $video->user->name }}</a>
        </p>
    @endforeach
</div>

{{--Photo--}}
<h5 onclick="collapseArea('route-photo-area', this)"><span>-</span> Photos</h5>
<div id="route-photo-area">
    @foreach($route->photos as $photo)
        <p>
            <a href="/storage/photos/crags/1300/{{ $photo->slug_label }}">{{ $photo->slug_label }}</a><br>
            par : <a href="{{ route('userPage', ['user_id'=>$photo->user->id, 'user_label'=>str_slug($photo->user->name)]) }}">{{ $photo->user->name }}</a>
        </p>
    @endforeach
</div>
@inject('Helpers','App\Lib\HelpersTemplates')

<table class=" striped table-list-last-route">
    <tbody>
        @foreach($routes as $route)
            <tr>
                <td><img class="tooltipped" {!! $Helpers::tooltip($route->climb->label) !!} src="/img/climb-{{ $route->climb_id }}.png" alt="" height="10"></td>
                <td>
                    @if(count($route->routeSections) > 1)
                        {{ count($route->routeSections) }} L.
                    @else
                        <span class="color-grade-{{ $route->routeSections[0]->grade_val }}">{{ $route->routeSections[0]->grade }} {{ $route->routeSections[0]->sub_grade }}</span>
                    @endif
                </td>
                <td><span onclick="loadRoute({{$route->id}})" class="button-open-route">{{ $route->label }}</span></td>
                <td><a href="{{ route('cragPage', ['crag_id'=>$route->crag->id,'crag_label'=>str_slug($route->crag->label)]) }}">{{ $route->crag->label }}</a></td>
                <td>{{ $route->height }} mètres</td>
                <td>
                    <a {!! $Helpers::tooltip('ajouté par' . $route->user->label) !!} href="{{ route('userPage',['user_id'=>$route->user->id,'user_label'=>str_slug($route->user->label)]) }}">{{ $route->user->name }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        @if($sector->routes_count > 0)
            <table>
                <tbody>
                @foreach($sector->routes as $route)
                    <tr onclick="getGymRoute({{ $route->id }}, '{{ $route->label }}'); animationLoadSideNav('r')">
                        <td>
                            @foreach($route->colors() as $color)
                                <div class="z-depth-2" style="background-color: {{ $color }}; height: 0.6em; width: 0.6em; border-radius: 50%"></div>
                            @endforeach
                        </td>
                        <td><span class="color-grade-{{ $route->val_grade }}">{{ $route->grade }}</span></td>
                        <td>{{ $route->label }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-italic grey-text text-center">Il n'y a pas de ligne dans ce secteur</p>
        @endif
    </div>
</div>
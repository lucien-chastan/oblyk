
@if(count($massives) > 0)
    <table class="bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($massives as $massive)
            <tr>
                <td onclick="selectMassive({{$massive->id}})"><a class="btn-flat waves-effect">{{$massive->label}}</a></td>
                <td><a target="_blank" href="{{ $massive->url() }}">voir le groupe</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-center grey-text">
        il n'y a pas de groupe dans les {{$rayon}} Km autour de ce site<br>
        Tu peux élargire la zone de recherche ou créer un nouveau groupe
    </p>
@endif

<p class="text-right">
    <a class="btn waves-effect" onclick="getMassiveArround()">Élargir la recherche à {{$rayon + 50}} Km</a>
</p>

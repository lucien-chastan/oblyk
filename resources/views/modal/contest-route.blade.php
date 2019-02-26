@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" action="{{ '/contestRoutes' }}" method="post">
    {{ csrf_field() }}
    {!! $Inputs::popupError() !!}

    <p class="no-margin grey-text text-right">
        <span onclick="checkAll(true)">
            <i class="material-icons">done_all</i> @lang('pages/profile/analytiks.allDone')
        </span>
        <span onclick="checkAll(false)">
            <i class="material-icons">crop_square</i> @lang('pages/profile/analytiks.allUndone')
        </span>
    </p>

    <div class="row">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Miniature</th>
                    <th></th>
                    <th>Cote</th>
                    <th>Nom</th>
                    <th>Référence</th>
                    <th>Secteur</th>
                    <th>Espace</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataModal['routes'] as $route)
                    <tr>
                        <td>
                            <input {{ (in_array($route->id, $dataModal['selectedRoutes']) ? 'checked' : '') }} name="contestRoutes[]" value="{{ $route->id }}" id="checkbox-route-{{ $route->id }}" class="check-route-for-contest" type="checkbox">
                            <label for="checkbox-route-{{ $route->id }}"></label>
                        </td>
                        <td>
                            @if($route->hasThumbnail())
                                <img src="{{ $route->thumbnail() }}" alt="" height="50" class="circle">
                            @endif
                        </td>
                        <td>
                            @foreach($route->colors() as $color)
                                <span class="z-depth-2 hold-tag-color" style="background-color: {{ $color }};"></span>
                            @endforeach
                        </td>
                        <td>{!! $route->grades('html', 'text-bold') !!}</td>
                        <td><a href="{{ $route->sector->room->url() }}#line-{{ $route->id }}" target="_blank">{{ $route->name() }}</a></td>
                        <td class="grey-text">{{ $route->reference }}</td>
                        <td><a href="{{ $route->sector->room->url() }}#sector-{{ $route->sector->id }}" target="_blank">{{ $route->sector->label }}</a></td>
                        <td><a href="{{ $route->sector->room->url() }}" target="_blank">{{ $route->sector->room->label }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Séléctionner les blocs</button>
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'contest_id','value'=>$dataModal['contest_id']]) !!}
</form>

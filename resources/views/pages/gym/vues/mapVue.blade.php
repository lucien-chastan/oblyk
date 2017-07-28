@inject('Helpers','App\Lib\HelpersTemplates')

<input hidden id="gymLat" value="{{$gym->lat}}">
<input hidden id="gymLng" value="{{$gym->lng}}">
<input hidden id="gymId" value="{{$gym->id}}">

<div class="row">
    <div class="col s12">
        <div class="card-panel">

            {{--carte--}}
            <div id="gym-map" class="gym-map"></div>

        </div>
    </div>
</div>
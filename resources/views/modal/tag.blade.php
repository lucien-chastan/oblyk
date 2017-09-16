@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}
    <div class="row">
        <div class="input-field col s12">
            <input placeholder="filtrer les tags" id="search_tags" type="text" onkeyup="searchTags()">
            <label for="search_tags">Rechercher un tag</label>
        </div>
    </div>
    <div class="row">
        @for($i = 1 ; $i <= 50 ; $i++)
            <div class="col s6 m4 tag_div" data-tag="{{trans('elements/tags.tag_' . $i)}}">
                {!! $Inputs::checkbox(['name'=>'check_tag_route', 'id'=>'checkbox-tag-' . $i, 'value'=>$i , 'label'=> trans('elements/tags.tag_' . $i), 'checked' => in_array($i, $dataModal['routeTags']) ? true : false, 'align' => 'left', 'onchange'=>'parseTags()']) !!}
            </div>
        @endfor
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'route_id','value'=>$dataModal['route_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'tagsList', 'id'=>'tagsList','value'=> implode(';', $dataModal['routeTags'])]) !!}
</form>

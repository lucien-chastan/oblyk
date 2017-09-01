@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row row-crag-gallerie">

    @if(count($sector->photos) > 0)

        <div id="zone-sector-gallerie-{{$sector->id}}">
            <div id="sectorPhototheque-{{$sector->id}}" class="phototheque">
                @foreach($sector->photos as $photo)
                    <img data-full="/storage/photos/crags/1300/{{$photo->slug_label}}" data-legende="{{$photo->description}}<br>{{trans('modals/photo.dataLegende', ['elementUrl'=>route('cragPage',['crag_id'=>$sector->crag_id, 'crag_label'=>str_slug($sector->label)]), 'elementLabel'=>$sector->label, 'userUrl'=>route('userPage', ['user_id'=>$photo->user_id, 'user_label'=>str_slug($photo->user->name)]), 'userName'=>$photo->user->name])}}" alt="{{$sector->label}} - {{$photo->description}}" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                @endforeach
            </div>
        </div>

        @if(Auth::check())

            <div class="col s12" id="bt-show-sector-gallerie-editor-{{$sector->id}}">
                <div class="info-user grey-text i-cursor">
                    <i {!! $Helpers::tooltip(trans('pages/crags/tabs/sectors/tabs/photo.tooltipBtEdit')) !!} onclick="showPhotoSectorEditor(true, {{$sector->id}})" class="material-icons tiny-btn right tooltipped">edit</i>
                </div>
            </div>

            <div class="col s12 zone-photo-editor" id="zone-sector-photo-editor-{{$sector->id}}">

                <h2 class="loved-king-font text-center">@lang('pages/crags/tabs/sectors/tabs/photo.titleActionPhoto')</h2>

                <div class="row">
                    @foreach($sector->photos as $photo)
                        <div class="col s6 m4 l3 text-center">
                            <div class="card">
                                <div class="card-image">
                                    <img alt="{{$sector->label}} - {{$photo->description}}" style="height: 100px; object-fit: cover" src="/storage/photos/crags/200/{{$photo->slug_label}}">
                                </div>
                                <div class="card-content i-cursor">
                                    <p>
                                        <i {!! $Helpers::tooltip(trans('modals/photo.headbandTooltip')) !!} {!! $Helpers::modal(route('bandeauModal'), ["photo_id"=>$photo->id, "crag_id"=>$sector->crag_id]) !!} class="material-icons tiny-btn tooltipped btnModal">wallpaper</i>
                                        <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$photo->id, "model"=>"Photo"]) !!} class="material-icons tiny-btn tooltipped btnModal">flag</i>
                                        @if(Auth::id() == $photo->user_id)
                                            <i {!! $Helpers::tooltip(trans('modals/photo.editTooltip')) !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$sector->id, "illustrable_type"=>"Sector", "photo_id"=>$photo->id, "title"=>trans('modals/photo.modalEditeTitle'), "method"=>"PUT", "callback"=>"reloadPhotoSector"]) !!} class="material-icons tiny-btn tooltipped btnModal">edit</i>
                                            <i {!! $Helpers::tooltip(trans('modals/photo.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/photos/" . $photo->id, "callback"=>"reloadPhotoSector"]) !!} class="material-icons tiny-btn tooltipped btnModal">delete</i>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="info-user grey-text i-cursor col s12">
                        <i {!! $Helpers::tooltip(trans('pages/crags/tabs/sectors/tabs/photo.closeActionPhoto')) !!} onclick="showPhotoSectorEditor(false, {{$sector->id}})" class="material-icons tiny-btn right tooltipped">clear</i>
                    </div>
                </div>
            </div>
        @endif

    @else
        <p class="text-center grey-text">@lang('pages/crags/tabs/sectors/tabs/photo.noPhoto')</p>
    @endif

    {{--BOUTON POUR AJOUTER UNE PHOTO--}}
    @if(Auth::check())
        <div class="text-right">
            <a {!! $Helpers::tooltip(trans('modals/photo.addTooltip')) !!} {!! $Helpers::modal(route('photoModal'), ["illustrable_id"=>$sector->id, "illustrable_type"=>"Sector", "photo_id"=>'', "title"=>trans('modals/photo.modalAddTitle'), "method"=>"POST", "callback"=>"reloadPhotoSector"]) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
        </div>
    @endif
</div>
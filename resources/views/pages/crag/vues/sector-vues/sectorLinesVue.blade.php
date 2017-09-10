@inject('Helpers','App\Lib\HelpersTemplates')

@if(count($routes) > 0)

    <table class="striped responsive-table">
        <tr>
            <th></th>
            <th>@lang('pages/crags/tabs/sectors/tabs/route.columnNote')</th>
            <th>@lang('pages/crags/tabs/sectors/tabs/route.columnGrade')</th>
            <th>@lang('pages/crags/tabs/sectors/tabs/route.columnName')</th>
            <th>@lang('pages/crags/tabs/sectors/tabs/route.columnType')</th>
            <th>@lang('pages/crags/tabs/sectors/tabs/route.columnHeight')</th>
            <th>@lang('pages/crags/tabs/sectors/tabs/route.columnYear')</th>
            <th>@lang('pages/crags/tabs/sectors/tabs/route.columnOpener')</th>
            <th></th>
        </tr>
    @foreach($routes as $route)

        <tr class="button-open-route text-cursor blue-hover" onclick="loadRoute({{$route->id}})">
            <td class="button-open-route" onclick="loadRoute({{$route->id}},'carnet');event.stopPropagation();">
                @if(isset($route->tickLists[0]->id))
                    <i {!! $Helpers::tooltip('Fait partie de ma tick-list') !!} class="material-icons tooltipped">crop_free</i>
                @endif
                @if(isset($route->crosses[0]->id))
                    @if($route->crosses[count($route->crosses) - 1]->status_id == 1)
                        <i {!! $Helpers::tooltip(trans('elements/statuses.status_1')) !!} class="material-icons tooltipped">crop_square</i>
                    @endif
                    @if($route->crosses[count($route->crosses) - 1]->status_id == 2)
                        <i {!! $Helpers::tooltip(trans('elements/statuses.status_2')) !!} class="material-icons tooltipped">done</i>
                    @endif
                    @if($route->crosses[count($route->crosses) - 1]->status_id == 3)
                        <i {!! $Helpers::tooltip(trans('elements/statuses.status_3')) !!} class="material-icons tooltipped">check_box</i>
                    @endif
                    @if($route->crosses[count($route->crosses) - 1]->status_id == 4)
                        <i {!! $Helpers::tooltip(trans('elements/statuses.status_4')) !!} class="material-icons tooltipped">flash_on</i>
                    @endif
                    @if($route->crosses[count($route->crosses) - 1]->status_id == 5)
                        <i {!! $Helpers::tooltip(trans('elements/statuses.status_5')) !!} class="material-icons tooltipped">visibility</i>
                    @endif
                    @if($route->crosses[count($route->crosses) - 1]->status_id == 6)
                        <i {!! $Helpers::tooltip(trans('elements/statuses.status_6')) !!} class="material-icons tooltipped">repeat</i>
                    @endif
                @else
                    @if(!isset($route->tickLists[0]->id) && Auth::check())
                        <i {!! $Helpers::tooltip(trans('pages/crags/tabs/sectors/tabs/route.addTooltip')) !!} class="material-icons tooltipped grey-text text-lighten-1">radio_button_unchecked</i>
                    @endif
                @endif
            </td>
            <td><img {!! $Helpers::tooltip(trans_choice('pages/crags/tabs/sectors/tabs/route.evaluation', $route->nb_note)) !!} src="/img/note_{{$route->note}}.png" alt="" class="tooltipped img-note-route-sector"></td>
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
                    <i {!! $Helpers::tooltip(trans('pages/crags/tabs/sectors/tabs/route.alertHeight')) !!} class="tooltipped material-icons red-text left">report_problem</i>
                @endif
                {{ trans_choice('pages/crags/tabs/sectors/tabs/route.height', $route->height) }}
            </td>
            <td>{{$route->open_year}}</td>
            <td>{{$route->opener}}</td>
            <td>
                @if($route->descriptions_count > 0)
                    <i {!! $Helpers::tooltip(trans_choice('pages/crags/tabs/sectors/tabs/route.nbDescription', $route->descriptions_count)) !!} class="tooltipped material-icons tiny">comment</i>
                @endif
                @if($route->photos_count > 0)
                    <i onclick="loadRoute({{$route->id}},'photo');event.stopPropagation();" {!! $Helpers::tooltip(trans_choice('pages/crags/tabs/sectors/tabs/route.nbPhoto', $route->photos_count)) !!} class="tooltipped material-icons tiny button-open-route">photo_camera</i>
                @endif
                @if($route->videos_count > 0)
                    <i onclick="loadRoute({{$route->id}},'video');event.stopPropagation();" {!! $Helpers::tooltip(trans_choice('pages/crags/tabs/sectors/tabs/route.nbVideo', $route->videos_count)) !!} class="tooltipped material-icons tiny button-open-route">videocam</i>
                @endif
            </td>
        </tr>

    @endforeach
    </table>

@else

    <p class="grey-text text-center">@lang('pages/crags/tabs/sectors/tabs/route.noRoute')</p>

@endif


{{--BOUTON POUR AJOUTER UN LIGNE--}}
@if(Auth::check())
    <div class="row">
        <div class="text-right col s12">
            <a {!! $Helpers::tooltip(trans('modals/route.addTooltip')) !!} {!! $Helpers::modal(route('routeModal'),['sector_id' => $sector->id, 'crag_id' => $sector->crag_id ,'title'=>trans('modals/route.modalAddTitle'),'method'=>'POST']) !!} class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">add</i></a>
        </div>
    </div>
@endif
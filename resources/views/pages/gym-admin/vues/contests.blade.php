@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        @if(count($contests) > 0)
            @foreach($contests as $contest)
                <div class="card-panel blue-card-panel">
                    <div class="row">

                        {{-- Information --}}
                        <div class="col s8">
                            <h4 class="loved-king-font">{{ $contest->name() }}</h4>
                            <div class="markdownZone">@markdown($contest->description)</div>
                            <table class="admin-contest-table">
                                <tr>
                                    <th>Période :</th>
                                    <td>
                                        Commence le {{ $contest->start_at->format('d/m/Y') }} à {{ $contest->start_at->format('H:i') }},
                                        fin le {{ $contest->end_at->format('d/m/Y') }} à {{ $contest->end_at->format('H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nombre de participant :</th>
                                    <td>
                                        {{ $contest->numberOfParticipants(true) }} / {{ ($contest->participantsAreLimited()) ? $contest->participant_limit : '∞' }}
                                        @if($contest->subscribersNeedToBeValidated())
                                            <span class="grey-text">({{ $contest->numberOfParticipants() - $contest->numberOfParticipants(true) }} participants sont en attente de validation)</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nombre de ligne :</th>
                                    <td>{{ $contest->numberOfRoutes() }}</td>
                                </tr>
                                <tr>
                                    <th>Dépassement :</th>
                                    <td>
                                        @if($contest->haveAdditionalTime())
                                            Vous autorisez les participants à noter leur lignes pendant <strong>{{ $contest->minutes_after_end }} minutes</strong> après la fin du contest
                                        @else
                                            Vous n'autorisez pas les participants à noter leurs lignes après la fin du contest
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Options :</th>
                                    <td>
                                        <ul>
                                            <li>
                                                <i class="material-icons left">{{ $contest->isRealTimeResult() ? 'check_box' : 'check_box_outline_blank' }}</i>
                                                Le classement s'affiche en temps réel
                                            </li>
                                            <li>
                                                <i class="material-icons left">{{ $contest->areRouteHiddenBeforeTheContest() ? 'check_box' : 'check_box_outline_blank' }}</i>
                                                Les lignes sont affichée sur le topo uniquement après le début du contest
                                            </li>
                                            <li>
                                                <i class="material-icons left">{{ $contest->subscribersNeedToBeValidated() ? 'check_box' : 'check_box_outline_blank' }}</i>
                                                Les grimpeurs peuvent participer uniquement après votre validation
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @if($contest->hasValidationMessage())
                                    <tr>
                                        <th>Message de validation</th>
                                        <td>{{ $contest->validation_message }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Video :</th>
                                    <td>
                                        @if($contest->hasPresentationVideo())
                                            @php($presentationVideo = $contest->presentationVideo())
                                            Votre contest a une vidéo de présentation<br>
                                            <span {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$contest->id, "viewable_type"=>"Contest", "video_id"=>$presentationVideo->id, "title"=>trans('modals/video.modalEditeTitle'), "method"=>"PUT", "callback" => 'reloadCurrentVue']) !!} class="blue-text btnModal text-cursor">modifier</span>
                                            <span {!! $Helpers::modal(route('deleteModal'), ["route"=>"/videos/" . $presentationVideo->id, "callback" => 'reloadCurrentVue']) !!} class="red-text btnModal text-cursor">supprimer</span>
                                        @else
                                            <button {!! $Helpers::modal(route('videoModal'), ["viewable_id"=>$contest->id, "viewable_type"=>"Contest", "video_id"=>'', "title"=>trans('modals/video.modalAddTitle'), "method"=>"POST"]) !!} class="btn-flat btnModal">Ajouter une vidéo de présentation <i class="material-icons left">videocam</i></button>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Contest Picture --}}
                        <div class="col s4">
                            @if($contest->hasCover())
                                <img src="{{ $contest->cover(500) }}" alt="conveture du contest" class="responsive-img">
                                <p class="text-center">
                                    <button {!! $Helpers::modal(route('contestUploadContestCoverModal', ['gym_id'=>$gym->id, 'contest_id'=>$contest->id]), ["gym_id"=>$gym->id, "id" => $contest->id , "title"=>'Uploader une couverture', "method"=>"POST"]) !!} class="btn-flat btnModal" type="button">Changer la couverture<i class="material-icons right">crop_original</i></button>
                                </p>
                            @else
                                <div class="text-center grey-text">
                                    <p>
                                        Vous n'avez pas uploadé d'image de couverture pour ce contest
                                    </p>
                                    <p>
                                        Par défaut l'image de couverture sera celle de votre salle
                                    </p>
                                    <p>
                                        <button {!! $Helpers::modal(route('contestUploadContestCoverModal', ['gym_id'=>$gym->id, 'contest_id'=>$contest->id]), ["gym_id"=>$gym->id, "id" => $contest->id , "title"=>'Uploader une couverture', "method"=>"POST"]) !!} class="btn-flat btnModal" type="button">Uploader une couverture<i class="material-icons right">crop_original</i></button>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Action --}}
                    <div class="row action-contest-row">
                        <p class="text-right">
                            <button {!! $Helpers::modal(route('deleteModal'), ["route" => "/contests/".$contest->id, "callback" => 'reloadCurrentVue']) !!} class="btn-flat red-text btnModal" type="button">Supprimer<i class="material-icons right">delete</i></button>
                            <button {!! $Helpers::modal(route('contestModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "id" => $contest->id , "title"=>'Modifier ce contest', "method"=>"PUT"]) !!} class="btn-flat btnModal" type="button">Modifier<i class="material-icons right">edit</i></button>
                            <a href="{{ $contest->url() }}" class="btn-flat blue-text" target="_blank">Voir la page<i class="material-icons right">launch</i></a>
                        </p>
                    </div>
                </div>
            @endforeach

            {{-- Add button --}}
            <div class="fixed-action-btn">
                <a {!! $Helpers::tooltip('Plannifier un nouveau contest') !!} {!! $Helpers::modal(route('contestModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Plannifier un nouveau contest', "method"=>"POST"]) !!} class="btn-floating btn-large red tooltipped btnModal">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        @else
            <div class="card-panel blue-card-panel text-center ">
                <p class="grey-text">
                    Vous n'avez créé aucun contest
                </p>
                <button {!! $Helpers::modal(route('contestModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Plannifier un nouveau contest', "method"=>"POST"]) !!} class="btn-flat btnModal">
                    <i class="material-icons left">star</i>
                    Plannifier un contest
                </button>
            </div>
        @endif
    </div>
</div>

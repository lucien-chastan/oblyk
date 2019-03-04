@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <table>
                    <tr>
                        <td>
                            <h5><i title="Retour" data-route="{{ route('gym_admin_grades_gym', ['gym_id' => $gym->id]) }}" onclick="loadProfileRoute(this)" class="material-icons left text-hover grey-text">keyboard_arrow_left</i> {{ $grade->label }}</h5>
                        </td>
                        <td>
                            <i {!! $Helpers::tooltip('Modifier ce système') !!} {!! $Helpers::modal(route('gymGradeModal', ['gym_id'=>$gym->id]), ["id" => $grade->id ,"gym_id"=>$gym->id, "title"=>'Modifier système de cotation', "method"=>"PUT"]) !!} class="material-icons grey-text right tooltipped text-hover btnModal">edit</i>
                            <i {!! $Helpers::tooltip('Supprimer ce système') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_grades/".$grade->id, "callback" => 'goToGrades']) !!} class="material-icons right tooltipped btnModal text-hover red-text text-lighten-3">delete</i>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                @if(count($grade->gradeLines) > 0)
                    <table class="highlight">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Cotation moyenne ?</th>
                                <th>Représenté par la couleur</th>
                                <th>Ordre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grade->gradeLines as $gradeLine)
                                <tr>
                                    <td>{{ $gradeLine->label }}</td>
                                    <td class="color-grade-{{ $gradeLine->grade_val }} text-bold">
                                        @if($gradeLine->grade_val != 0)
                                            {{ \App\Route::valToGrad($gradeLine->grade_val, true) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($gradeLine->colors() as $color)
                                            <i class="material-icons left" style="color: {{ $color }}">bookmark</i>
                                        @endforeach
                                    </td>
                                    <td>{{ $gradeLine->order }}</td>
                                    <td>
                                        <i {!! $Helpers::tooltip('Supprimer ce niveau') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_grade_lines/{$gradeLine->id}", "callback"=>"reloadCurrentVue"]) !!} class="material-icons red-text right tooltipped text-hover text-lighten-3 btnModal">delete</i>
                                        <i {!! $Helpers::tooltip('Modifier ce niveau') !!} {!! $Helpers::modal(route('gymGradeLineModal', ['gym_id' => $gym->id]), ["id" => $gradeLine->id ,"gym_id"=>$gym->id, "gym_grade_id"=>$grade->id, "title"=>'Modifier ce niveau', "method"=>"PUT"]) !!} class="material-icons right grey-text text-hover tooltipped btnModal">edit</i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center grey-text text-italic">
                        Vous n'avez pas encore défini de niveau de difficulté dans ce système de cotation
                    </p>
                @endif
            </div>
            <div class="row text-right">
                <button {!! $Helpers::modal(route('gymGradeLineModal', ['gym_id' => $gym->id]), ["gym_id"=>$gym->id, "gym_grade_id"=>$grade->id, "title"=>'Ajouter un niveau de difficulté', "method"=>"POST"]) !!} class="btn-flat btnModal">
                    <i class="material-icons left">add</i>
                    Ajouter un niveau de difficulté
                </button>
            </div>
        </div>
    </div>
</div>
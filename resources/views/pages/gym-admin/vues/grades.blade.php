@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        @if(count($grades) > 0)
            @foreach($grades as $grade)
                <div class="card-panel blue-card-panel">
                    <div class="row">
                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        {{ $grade->label }}
                                        <i title="Voir sur une page séparée" data-route="{{ route('gym_admin_grade_lines_gym', ['gym_id' => $gym->id, 'gym_grade_id'=>$grade->id]) }}"
                                           onclick="loadProfileRoute(this)"
                                           class="material-icons left text-hover blue-text">launch</i>
                                    </th>
                                    <th>
                                        <i {!! $Helpers::tooltip('Supprimer ce système') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_grades/".$grade->id, "callback" => 'goToGrades']) !!} class="material-icons right tooltipped btnModal text-hover red-text text-lighten-3">delete</i>
                                        <i {!! $Helpers::tooltip('Modifier ce système') !!} {!! $Helpers::modal(route('gymGradeModal', ['gym_id'=>$gym->id]), ["id" => $grade->id ,"gym_id"=>$gym->id, "title"=>'Modifier système de cotation', "method"=>"PUT"]) !!} class="material-icons grey-text right tooltipped text-hover btnModal">edit</i>
                                    </th>
                                </tr>
                            </thead>
                            @if($grade->system_can_have_levels())
                                <tbody>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Cotation moyenne</th>
                                        <th>Couleurs</th>
                                        <th></th>
                                    </tr>
                                    @foreach($grade->gradeLines as $gradeLine)
                                        <tr>
                                            <td>
                                                <span class="grey-text">{{ $gradeLine->order }} -</span> {{ $gradeLine->label }}
                                            </td>
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
                                            <td>
                                                <i {!! $Helpers::tooltip('Supprimer ce niveau') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_grade_lines/{$gradeLine->id}", "callback"=>"reloadCurrentVue"]) !!} class="material-icons red-text right tooltipped text-hover text-lighten-3 btnModal">delete</i>
                                                <i {!! $Helpers::tooltip('Modifier ce niveau') !!} {!! $Helpers::modal(route('gymGradeLineModal', ['gym_id' => $gym->id]), ["id" => $gradeLine->id ,"gym_id"=>$gym->id, "gym_grade_id"=>$grade->id, "title"=>'Modifier ce niveau', "method"=>"PUT"]) !!} class="material-icons right grey-text text-hover tooltipped btnModal">edit</i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                        <p>@lang('elements/difficulty-system.system_' . $grade->difficulty_system)</p>

                        @if($grade->system_can_have_levels())
                            <div class="text-right">
                                <button {!! $Helpers::modal(route('gymGradeLineModal', ['gym_id' => $gym->id]), ["gym_id"=>$gym->id, "gym_grade_id"=>$grade->id, "title"=>'Ajouter un niveau de difficulté', "method"=>"POST"]) !!} class="btn-flat btnModal">
                                    <i class="material-icons left">add</i>
                                    Ajouter un niveau de difficulté
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center grey-text text-italic">
                Vous n'avez pas encore défini de système de cotation
            </p>
            <p class="text-center">
                Les systèmes de cotation sont les échelles de difficultés que vous utilisez.<br>
                Vous pourriez par exemple avoir des étiquettes ou des couleurs de prise qui représentent la difficulté
                de la voie.<br>
            </p>
            <p class="text-center">
                Renseigner vos systèmes de cotation vous permet de créer vos voies plus rapidement par la suite.
            </p>
            <p class="text-center">
                <button {!! $Helpers::modal(route('gymGradeModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un système de cotation', "method"=>"POST"]) !!} class="btn-flat btnModal">
                    <i class="material-icons left">add</i>
                    Créer un système de cotation
                </button>
            </p>
        @endif
    </div>
</div>

<div class="fixed-action-btn">
    <a {!! $Helpers::tooltip('Ajouter un système de cotation') !!} {!! $Helpers::modal(route('gymGradeModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un système de cotation', "method"=>"POST"]) !!} id="scheme-btn-modal"
       class="btn-floating btn-large red tooltipped btnModal">
        <i class="large material-icons">add</i>
    </a>
</div>

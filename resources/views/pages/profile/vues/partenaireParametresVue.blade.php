@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel partner-settings-zone">

            <button class="btn-flat right waves-effect blue-text" onclick="loadProfileRoute(document.getElementById('item-mes-lieux-nav'))">Mes Lieux<i class="material-icons right">arrow_forward</i></button>

            <h2 class="loved-king-font titre-profile-boite-vue">Qui je suis ?</h2>

            <p>
                <strong class="text-underline">Pourquoi cette page ?</strong><br>
                Pour que d'autres grimpeurs et envie de te contacter, il est important qu'ils aient un minimum d'informations sur toi.
                Cette page te permet de donne quelques indicateurs de qui tu es, ton niveau, quelle type de grimpe tu pratique, etc.
            </p>

            <form id="form-partner-setting" class="submit-form" data-route="{{route('saveUserPartnerSettings')}}" onsubmit="submitData(this, majPartnerSettings); return false">

                {!! $Inputs::popupError([]) !!}

                <div class="blue-border-zone">

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">1. Faire partie de la recherche de partenaire d'oblyk</p>
                        {!! $Inputs::checkbox(['name'=>'partner', 'label'=>'Activer ma recherche de partenaire de grimpe', 'checked' => ($user->partnerSettings->partner == 1) ? true : false, 'align' => 'left']) !!}

                        <p class="grey-text para-note-active-partner">Note :</p>
                        <ul class="grey-text oblyk-ul">
                            <li>
                                Si cette case n'est pas cochée, tu n'apparaîtra pas sur la carte des grimpeurs
                            </li>
                            <li>
                                Désactiver ton profil de la recherche de partenaire ne supprime pas tes préférences ni tes lieux de grimpe, tu deviens juste invisible.
                            </li>
                        </ul>
                    </div>

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">2. Quel type de grimpe je pratique ?</p>
                        {!! $Inputs::checkbox(['name'=>'climb_2', 'label'=>'Bloc', 'checked' => ($user->partnerSettings->climb_2 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_3', 'label'=>'Voie', 'checked' => ($user->partnerSettings->climb_3 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_4', 'label'=>'Grande-voie', 'checked' => ($user->partnerSettings->climb_4 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_5', 'label'=>'Trad', 'checked' => ($user->partnerSettings->climb_5 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_6', 'label'=>'Artif', 'checked' => ($user->partnerSettings->climb_6 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_7', 'label'=>'Deep-water', 'checked' => ($user->partnerSettings->climb_7 == 1) ? true : false, 'align' => 'left']) !!}
                        {!! $Inputs::checkbox(['name'=>'climb_8', 'label'=>'Via-ferrata', 'checked' => ($user->partnerSettings->climb_8 == 1) ? true : false, 'align' => 'left']) !!}
                    </div>

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">3. Quel est mon niveau ?</p>
                        <div class="input-field col s12">
                            <select id="grade_min" class="input-data" name="grade_min">
                                <option value="2a" @if($user->partnerSettings->grade_min == '2a') selected @endif >2a</option>
                                <option value="2b" @if($user->partnerSettings->grade_min == '2b') selected @endif >2b</option>
                                <option value="2c" @if($user->partnerSettings->grade_min == '2c') selected @endif >2c</option>

                                <option value="3a" @if($user->partnerSettings->grade_min == '3a') selected @endif >3a</option>
                                <option value="3b" @if($user->partnerSettings->grade_min == '3b') selected @endif >3b</option>
                                <option value="3c" @if($user->partnerSettings->grade_min == '3c') selected @endif >3c</option>

                                <option value="4a" @if($user->partnerSettings->grade_min == '4a') selected @endif >4a</option>
                                <option value="4b" @if($user->partnerSettings->grade_min == '4b') selected @endif >4b</option>
                                <option value="4c" @if($user->partnerSettings->grade_min == '4c') selected @endif >4c</option>

                                <option value="5a" @if($user->partnerSettings->grade_min == '5a') selected @endif >5a</option>
                                <option value="5b" @if($user->partnerSettings->grade_min == '5b') selected @endif >5b</option>
                                <option value="5c" @if($user->partnerSettings->grade_min == '5c') selected @endif >5c</option>

                                <option value="6a" @if($user->partnerSettings->grade_min == '6a') selected @endif >6a</option>
                                <option value="6b" @if($user->partnerSettings->grade_min == '6b') selected @endif >6b</option>
                                <option value="6c" @if($user->partnerSettings->grade_min == '6c') selected @endif >6c</option>

                                <option value="7a" @if($user->partnerSettings->grade_min == '7a') selected @endif >7a</option>
                                <option value="7b" @if($user->partnerSettings->grade_min == '7b') selected @endif >7b</option>
                                <option value="7c" @if($user->partnerSettings->grade_min == '7c') selected @endif >7c</option>

                                <option value="8a" @if($user->partnerSettings->grade_min == '8a') selected @endif >8a</option>
                                <option value="8b" @if($user->partnerSettings->grade_min == '8b') selected @endif >8b</option>
                                <option value="8c" @if($user->partnerSettings->grade_min == '8c') selected @endif >8c</option>

                                <option value="9a" @if($user->partnerSettings->grade_min == '9a') selected @endif >9a</option>
                                <option value="9b" @if($user->partnerSettings->grade_min == '9b') selected @endif >9b</option>
                                <option value="9c" @if($user->partnerSettings->grade_min == '9c') selected @endif >9c</option>
                            </select>
                            <label for="grade_min">Mon niveau minimum</label>
                        </div>
                        <div class="input-field col s12">
                            <select id="grade_max" class="input-data" name="grade_max">
                                <option value="2a" @if($user->partnerSettings->grade_max == '2a') selected @endif >2a</option>
                                <option value="2b" @if($user->partnerSettings->grade_max == '2b') selected @endif >2b</option>
                                <option value="2c" @if($user->partnerSettings->grade_max == '2c') selected @endif >2c</option>

                                <option value="3a" @if($user->partnerSettings->grade_max == '3a') selected @endif >3a</option>
                                <option value="3b" @if($user->partnerSettings->grade_max == '3b') selected @endif >3b</option>
                                <option value="3c" @if($user->partnerSettings->grade_max == '3c') selected @endif >3c</option>

                                <option value="4a" @if($user->partnerSettings->grade_max == '4a') selected @endif >4a</option>
                                <option value="4b" @if($user->partnerSettings->grade_max == '4b') selected @endif >4b</option>
                                <option value="4c" @if($user->partnerSettings->grade_max == '4c') selected @endif >4c</option>

                                <option value="5a" @if($user->partnerSettings->grade_max == '5a') selected @endif >5a</option>
                                <option value="5b" @if($user->partnerSettings->grade_max == '5b') selected @endif >5b</option>
                                <option value="5c" @if($user->partnerSettings->grade_max == '5c') selected @endif >5c</option>

                                <option value="6a" @if($user->partnerSettings->grade_max == '6a') selected @endif >6a</option>
                                <option value="6b" @if($user->partnerSettings->grade_max == '6b') selected @endif >6b</option>
                                <option value="6c" @if($user->partnerSettings->grade_max == '6c') selected @endif >6c</option>

                                <option value="7a" @if($user->partnerSettings->grade_max == '7a') selected @endif >7a</option>
                                <option value="7b" @if($user->partnerSettings->grade_max == '7b') selected @endif >7b</option>
                                <option value="7c" @if($user->partnerSettings->grade_max == '7c') selected @endif >7c</option>

                                <option value="8a" @if($user->partnerSettings->grade_max == '8a') selected @endif >8a</option>
                                <option value="8b" @if($user->partnerSettings->grade_max == '8b') selected @endif >8b</option>
                                <option value="8c" @if($user->partnerSettings->grade_max == '8c') selected @endif >8c</option>

                                <option value="9a" @if($user->partnerSettings->grade_max == '9a') selected @endif >9a</option>
                                <option value="9b" @if($user->partnerSettings->grade_max == '9b') selected @endif >9b</option>
                                <option value="9c" @if($user->partnerSettings->grade_max == '9c') selected @endif >9c</option>
                            </select>
                            <label for="grade_max">Mon niveau maxium</label>
                        </div>
                        <p class="grey-text">
                            Note : si tu ne sais pas quoi mettre, ton niveau minium pourait correspondre à ton échauffement, et ton niveau max à tes projets.
                        </p>
                    </div>

                    <div class="blue-border-div">
                        <p class="text-bold text-underline">4. Pourquoi ne pas parler un peut plus de toi ?</p>
                        {!! $Inputs::mdText(['name'=>'description', 'label'=>'Qui je suis avec mes mots', 'value'=>$user->partnerSettings->description]) !!}
                        <p class="grey-text">
                            Note : tu peux par exemple préciser ce que tu recherche, te décrir plus amplement, parler de ton matériel d'escalade ou de tes connaissances dans les manipes par exemple.
                        </p>
                    </div>

                    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

                    <div class="row">
                        {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false]) !!}
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
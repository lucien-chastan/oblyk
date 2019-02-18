@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>'Ajouter un menbre à l\'équipe']) !!}

<div class="row">
    <div class="col s12">
        <div class="input-field col s12">
            <input placeholder="chercher" id="search-user-name" type="text" onkeyup="searchUser()">
            <label for="first_name">Chercher un menbre</label>
        </div>
        <div id="find-user-list"></div>
    </div>
</div>

<input type="hidden" id="gym_id" value="{{ $gym->id }}">
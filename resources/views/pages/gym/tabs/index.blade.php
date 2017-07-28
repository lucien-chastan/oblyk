<div class="row stretchCol">

    {{--INOFRMATION SUR LA SALLE--}}
    <div class="col s12 m7">
        <div class="card-panel">
            <h2 class="loved-king-font">Informations sur {{ $gym->label }}</h2>
            @markdown($gym->description)
        </div>
    </div>

    {{--PETITE INFORMATION SUR LA SALLE--}}
    <div class="col s12 m5">
        <div class="card-panel">
            petites infos
        </div>
    </div>
</div>

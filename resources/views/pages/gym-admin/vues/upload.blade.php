@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <h2 class="loved-king-font" style="font-size: 2em;">Logo &amp; Bandeau</h2>

                <form id="form-upload-photo-profil-setting" class="submit-form row" onsubmit="return false">

                    {!! $Inputs::popupError() !!}
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="upload-settings-col-image">
                            <img src="{{ $gym->logo(100) }}?cache={{ date('Ymdhis') }}" alt="" class="circle left img-settings">
                        </div>
                        <div class="upload-settings-col-input">
                            {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$gym->id]) !!}
                            <div class="col s8">
                                {!! $Inputs::upload(['name'=>'logo', 'filter'=>'image/*', 'id'=>'upload-logo-gym' ,'label'=>'Parcourir', 'col' => 's6']) !!}
                            </div>
                            <div class="col s4">
                                <button class="btn" style="width: 100%; margin-top: 1.2em" onclick="uploadLogoGym()">Télécharger le logo</button>
                            </div>
                            {!! $Inputs::progressbar(['id'=>'progressbar-upload-logo-gym']) !!}
                        </div>
                    </div>

                </form>

                <form id="form-upload-photo-bandeau-setting" class="submit-form row" onsubmit="return false">

                    {!! $Inputs::popupError() !!}
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="upload-settings-col-image">
                            <div class="left img-settings grey darken-1" style="background-image: url('{{ $gym->bandeau(200) }}?cache={{ date('Ymdhis') }}')">

                            </div>
                        </div>
                        <div class="upload-settings-col-input">
                            {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$gym->id]) !!}
                            <div class="col s8">
                                {!! $Inputs::upload(['name'=>'bandeau', 'filter'=>'image/*', 'id'=>'upload-bandeau-gym' ,'label'=>'Parcourir']) !!}
                            </div>
                            <div class="col s4">
                                <button class="btn" style="width: 100%; margin-top: 1.2em" onclick="uploadBandeauGym()">Télécharger le bandeau</button>
                            </div>
                            {!! $Inputs::progressbar(['id'=>'progressbar-upload-bandeau-gym']) !!}
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

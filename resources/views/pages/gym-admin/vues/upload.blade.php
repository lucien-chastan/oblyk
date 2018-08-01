@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <h2 class="loved-king-font" style="font-size: 2em;">Logo &amp; Bandeau</h2>

                <form id="form-upload-photo-profil-setting" class="submit-form row" onsubmit="return false">

                    {!! $Inputs::popupError([]) !!}

                    <div class="row">
                        <div class="upload-settings-col-image">
                            <img src="{{ $gym->logo(50) }}?cache={{date('Ymdhis')}}" alt="" class="circle left img-settings">
                        </div>
                        <div class="upload-settings-col-input">
                            {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$gym->id]) !!}
                            {!! $Inputs::upload(['name'=>'logo', 'filter'=>'image/*', 'id'=>'upload-logo-gym' ,'label'=>'Changer le logo', 'onchange'=>'uploadLogoGym()']) !!}
                            {!! $Inputs::progressbar(['id'=>'progressbar-upload-logo-gym']) !!}
                        </div>
                    </div>

                </form>

                <form id="form-upload-photo-bandeau-setting" class="submit-form row" onsubmit="return false">

                    {!! $Inputs::popupError([]) !!}

                    <div class="row">
                        <div class="upload-settings-col-image">
                            <div class="left img-settings grey darken-1" style="background-image: url('{{ $gym->bandeau(200) }}')">

                            </div>
                        </div>
                        <div class="upload-settings-col-input">
                            {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$gym->id]) !!}
                            {!! $Inputs::upload(['name'=>'bandeau', 'filter'=>'image/*', 'id'=>'upload-bandeau-gym' ,'label'=>'Changer le bandeau', 'onchange'=>'uploadBandeauGym()']) !!}
                            {!! $Inputs::progressbar(['id'=>'progressbar-upload-bandeau-gym']) !!}
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{--<h3 class="title-admmin-gym">Changer le bandeau de {{ $gym->label }}</h3>--}}

{{--<form method="POST" name="uploadLogo" action="{{ route('uploadLogoBandeauSae') }}" enctype="multipart/form-data" class="col s12 l8 offset-l2">--}}
    {{--{{ csrf_field() }}--}}
    {{----}}
{{--</form>--}}

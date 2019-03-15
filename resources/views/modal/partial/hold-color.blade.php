<div class="row">
    <div class="col s12">
        <div class="col s12 l6">
            <p class="text-underline">Couleur des prises</p>
            {!! $Inputs::colorList(['name'=>'color_first', 'id'=>'firstColorGymRoute', 'label'=>'Première couleur', 'value'=>$colors[0] ?? '#0000000', 'placeholder'=>"Première couleur"]) !!}
        </div>
        <div class="col s12 l6">
            <p class="text-underline">
                {!! $Inputs::checkbox(['name'=>'use_second_color', 'id'=>'useSecondColorGymRoute', 'checked'=>($use_second_color == 1), 'label' => 'Prise bi-color']) !!}
            </p>
            {!! $Inputs::colorList(['name'=>'color_second', 'id'=>'secondColorGymRoute', 'label'=>'Second couleur', 'value'=>$colors[1] ?? '#0000000', 'placeholder'=>"Seconde couleur"]) !!}
        </div>
    </div>
</div>
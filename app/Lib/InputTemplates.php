<?php

namespace App\Lib;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class InputTemplates extends ServiceProvider{

    public function __construct(){
        //
    }

    public static function text($options){
        $name = $options['name'];
        $value = (isset($options['value']))? $options['value'] : '';
        $label = (isset($options['label']))? $options['label'] : $options['name'];
        $id = (isset($options['id']))? $options['id'] : $options['name'];

        return '
            <div class="input-field col s12">
                <input placeholder="' . $label . '" value="' . $value . '" id="'. $id .'" name="' . $name . '" type="text" class="validate">
                <label class="active" for="' . $id . '">' . $label . '</label>
            </div>
        ';
    }

    public static function SimpleMde($options){
        $name = $options['name'];
        $value = (isset($options['value']))? $options['value'] : '';

        return '
            <textarea name="' . $name . '" id="simplemde_id">' . $value . '</textarea>
        ';
    }

    public static function submit($options){

        return '
        <div class="row text-right">
            <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                <i class="material-icons right">send</i>
            </button>
        </div>
        ';
    }
}

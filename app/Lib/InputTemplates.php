<?php
namespace App\Lib;

class Inputs
{
    public static function Text()
    {

        //$id = $options->id;

        $html = '
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Placeholder" id="test" type="text" class="validate">
                    <label for="first_name">First Name</label>
                </div>
            </div>
        ';

        return $html;
    }
}

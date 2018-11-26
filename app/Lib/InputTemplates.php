<?php

namespace App\Lib;

use App\Album;
use App\Anchor;
use App\Climb;
use App\CrossHardness;
use App\CrossMode;
use App\CrossStatus;
use App\ForumGeneralCategory;
use App\GymSector;
use App\Incline;
use App\Point;
use App\RainExposure;
use App\Reception;
use App\Rock;
use App\Sector;
use App\SocialNetwork;
use App\Start;
use App\Sun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class InputTemplates extends ServiceProvider
{

    public function __construct()
    {
        //
    }

    // Popup title
    public static function popupTitle($options)
    {
        return view('inputs.popup-title', [
            'title' => $options['title']
        ]);
    }


    // <div> for error messages
    public static function popupError()
    {
        return view('inputs.popup-error');
    }


    // Hidden input type
    public static function Hidden($options)
    {
        return view('inputs.hidden', [
            'name' => $options['name'],
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'value' => $options['value'] ?? '',
        ]);
    }


    // Checkbox input
    public static function checkbox($options)
    {
        return view('inputs.checkbox', [
            'name' => $options['name'],
            'checked' => (isset($options['checked']) && $options['checked'] == 'true') ? 'checked' : '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'align' => (isset($options['align'])) ? 'text-' . $options['align'] : 'text-left',
            'value' => (isset($options['value'])) ? "value = " . $options['value'] : '',
            'onchange' => (isset($options['onchange'])) ? 'onchange="' . $options['onchange'] . '"' : "",
        ]);
    }


    // Albums list select
    public static function albums($options)
    {
        $Album = Album::class;
        $mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $albums = $Album::where('user_id', Auth::id())->get();
        $newAlbumName = $mois[date('n') - 1] . ' ' . date('Y');
        $value = (isset($options['value'])) ? $options['value'] : 0;

        $trouver = false;
        foreach ($albums as $album) {
            if ($newAlbumName == $album->label) {
                $trouver = true;
                if ($value == 0) $value = $album->id;
            }
        }

        return view('inputs.albums', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => $value,
            'albums' => $albums,
            'mois' => $mois,
            'newAlbum' => $trouver,
        ]);
    }

    // File type input
    public static function upload($options)
    {
        return view('inputs.upload', [
            'name' => $options['name'],
            'value' => $options['value'] ?? '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'filter' => (isset($options['filter'])) ? 'accept="' . $options['filter'] . '"' : '',
            'onchange' => (isset($options['onchange'])) ? 'onchange="' . $options['onchange'] . '"' : '',
        ]);
    }

    // Progressbar
    public static function progressbar($options)
    {
        return view('inputs.progressbar', [
            'id' => (isset($options['id'])) ? $options['id'] : 'popup-progressloader',
            'value' => (isset($options['value'])) ? $options['value'] : 0,
        ]);
    }


    // Text type input
    public static function text($options)
    {
        $value = $options['value'] ?? '';
        $placeholder = $options['placeholder'] ?? '';

        return view('inputs.text', [
            'name' => $options['name'],
            'value' => $value,
            'col' => $options['col'] ?? 's12',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'placeholder' => $placeholder,
            'type' => (isset($options['type'])) ? $options['type'] : 'text',
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'classLabel' => ($value != '' || $placeholder != '') ? 'active' : '',
            'icon' => $options['icon'] ?? '',
            'onkeyup' => (isset($options['onkeyup'])) ? ' onkeyup="' . $options['onkeyup'] . '"' : ''
        ]);
    }


    // Simple markdown editor textarea
    public static function SimpleMde($options)
    {
        return view('inputs.simple-mode', [
            'name' => $options['name'],
            'value' => $options['value'] ?? '',
        ]);
    }


    // Markdown editor textarea
    public static function mdText($options)
    {
        $value = $options['value'] ?? '';
        $placeholder = $options['placeholder'] ?? '';

        return view('inputs.markdown', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => $value,
            'placeholder' => $placeholder,
            'classLabel' => ($value != '' || $placeholder != '') ? 'active' : '',
        ]);
    }

    // Trumbowyg markdown editor
    public static function trumbowyg($options)
    {
        return view('inputs.trumbowyg', [
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'value' => $options['value'] ??  '',
            'class' => (isset($options['class'])) ? $options['class'] : 'trumbowyg-editor',
            'placeholder' => $options['placeholder'] ?? '',
        ]);
    }

    // Input type date
    public static function date($options)
    {
        return view('inputs.date', [
            'name' => $options['name'],
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => $options['value'] ?? '',
            'class' => $options['class'] ?? '',
            'placeholder' => $options['placeholder'] ?? '',
        ]);
    }

    // Submit button
    public static function submit($options)
    {
        return view('inputs.submit', [
            'label' => (isset($options['label'])) ? $options['label'] : 'Envoyer',
            'color' => (isset($options['color'])) ? $options['color'] : 'blue',
            'cancelable' => (isset($options['cancelable'])) ? false : true,
            'onclick' => (isset($options['onclick'])) ? ' onclick="' . $options['onclick'] . '"' : '',
        ]);
    }


    // Rocks select
    public static function rocks($options)
    {
        return view('inputs.rocks', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => (isset($options['icon'])) ?? '',
            'rocks' => Rock::all(),
        ]);
    }


    // Gym route type select
    public static function gymRoutesTypes($options)
    {
        return view('inputs.gym-route-type', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
        ]);
    }

    // Cross status select
    public static function crossStatuses($options)
    {
        return view('inputs.cross-statuses', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'statuses' => CrossStatus::all(),
        ]);
    }


    // Hardness cross select
    public static function crossHardnesses($options)
    {
        return view('inputs.cross-hardnesses', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'hardnesses' => CrossHardness::all(),
        ]);
    }


    // Cross modes select
    public static function crossModes($options)
    {
        return view('inputs.cross-modes', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'modes' => CrossMode::all(),
        ]);
    }


    // Forum category select
    public static function categories($options)
    {
        return view('inputs.categories', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'generalCategories' => ForumGeneralCategory::with('categories')->with('categories')->get(),
        ]);
    }

    // Sex select
    public static function sex($options)
    {
        return view('inputs.sex', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 0,
            'icon' => $options['icon'] ?? '',
        ]);
    }


    //SELECT DU TYPE DE GRIMPE
    public static function climbs($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $col = (isset($options['col'])) ? $options['col'] : '';
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $climbs = Climb::all();

        $html = '
            <div class="input-field col s12 ' . $col . '">
                ' . $icon . '
                <select onchange="optimisePopupRoute()" id="select-climbs-popup-route" class="input-data" name="' . $name . '">
        ';

        foreach ($climbs as $key => $climb) {
            if ($key != 0) {
                $selected = ($climb->id == $value) ? 'selected' : '';
                $html .= '<option class="left" data-icon="/img/icon-climb-' . ($key + 1) . '.png" ' . $selected . ' value="' . $climb->id . '">' . trans('elements/climbs.climb_' . $climb->id) . '</option>';
            }
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }


    //SELECT D'UNE NOTE
    public static function note($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $notes = [
            0 => trans('elements/notes.note_1'),
            1 => trans('elements/notes.note_2'),
            2 => trans('elements/notes.note_3'),
            3 => trans('elements/notes.note_4'),
            4 => trans('elements/notes.note_5'),
            5 => trans('elements/notes.note_6'),
            6 => trans('elements/notes.note_7'),
            7 => trans('elements/notes.note_8'),
        ];

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">';

        foreach ($notes as $key => $note) {
            $selected = ($value == $key) ? 'selected' : '';
            $html .= '<option class="left icon-modal-note" data-icon="/img/note_' . $key . '.png" ' . $selected . ' value="' . $key . '">' . $note . '</option>';
        }


        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }


    //SELECT DE L'ENSOLEILLEMENT
    public static function suns($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Suns = Sun::all();

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Suns as $sun) {
            $selected = ($sun->id == $value) ? 'selected' : '';
            $html .= '<option ' . $selected . ' value="' . $sun->id . '">' . ucfirst($sun->label) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }


    //SELECT DE L'EXPOSITION À LA PLUIE
    public static function rains($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Rains = RainExposure::all();

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Rains as $rain) {
            $selected = ($rain->id == $value) ? 'selected' : '';
            $html .= '<option ' . $selected . ' value="' . $rain->id . '">' . trans('elements/rains.rains_' . $rain->id) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }


    //INPUT TYPE ORIENTATION
    public static function orientations($options)
    {
        $label = (isset($options['label'])) ? $options['label'] : 'Orientations';
        $value = (isset($options['value'])) ? $options['value'] : ['north' => 0, 'south' => 0, 'east' => 0, 'west' => 0, 'north_east' => 0, 'north_west' => 0, 'south_east' => 0, 'south_west' => 0];
        $col = (isset($options['col'])) ? $options['col'] : 12;
        $orientable_type = $options['orientable_type'];
        $orientable_id = $options['orientable_id'];


        $html = '<div class="col s12 m' . $col . '"><label>' . $label . '</label>';
        $html .= '<input class="input-data" type="hidden" name="orientable_type" value="' . $orientable_type . '">';
        $html .= '<input class="input-data" type="hidden" name="orientable_id" value="' . $orientable_id . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_north" type="hidden" name="north" value="' . $value['north'] . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_east" type="hidden" name="east" value="' . $value['east'] . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_south" type="hidden" name="south" value="' . $value['south'] . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_west" type="hidden" name="west" value="' . $value['west'] . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_north_east" type="hidden" name="north_east" value="' . $value['north_east'] . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_north_west" type="hidden" name="north_west" value="' . $value['north_west'] . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_south_east" type="hidden" name="south_east" value="' . $value['south_east'] . '">';
        $html .= '<input class="hidden_orientation_input input-data" id="hidden_south_west" type="hidden" name="south_west" value="' . $value['south_west'] . '">';

        $html .= '
            <div class="text-center orientations-input">
                <svg version="1.1" viewBox="0 0 100.61393 100.61393" height="28.395487mm" width="28.395487mm">
                    <g transform="translate(-299.43062,-288.93568)">
                        <path onclick="switchOrientation(\'hidden_north\');" style="fill:fill-rule:evenodd;stroke:none" d="m 349.73758,288.93568 -11.20135,39.10561 11.20135,11.20135 0,-42.84708 9.54034,33.30673 1.66102,-1.661 z"></path>
                        <path onclick="switchOrientation(\'hidden_east\');" style="fill:fill-rule:evenodd;stroke:none" d="m 400.04455,339.24264 -39.10561,-11.20135 -11.20136,11.20135 42.84709,0 -33.30672,9.54034 1.66099,1.66104 z"></path>
                        <path onclick="switchOrientation(\'hidden_south\');" style="fill:fill-rule:evenodd;stroke:none" d="m 349.73758,389.54961 11.20136,-39.10561 -11.20136,-11.20136 0,42.84708 -9.54033,-33.30671 -1.66102,1.66099 z"></path>
                        <path onclick="switchOrientation(\'hidden_west\');" style="fill:fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 338.53623,328.04129 -39.10561,11.20135 39.10561,11.20136 11.20135,-11.20136 -42.84704,0 33.30671,-9.54033 z"></path>
                        <path onclick="switchOrientation(\'hidden_north_east\');" style="fill:fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 368.72625,330.27188 10.44405,-20.46195 -20.46194,10.44406 2.23058,7.7873 z"></path>
                        <path onclick="switchOrientation(\'hidden_north_west\');" style="fill:fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 340.76682,320.25398 -20.46195,-10.44405 10.44405,20.46195 7.78731,-2.23059 z"></path>
                        <path onclick="switchOrientation(\'hidden_south_east\');" style="fill:fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 358.70836,358.23133 20.46194,10.44403 -10.44405,-20.46194 -7.78731,2.23058 z"></path>
                        <path onclick="switchOrientation(\'hidden_south_west\');" style="fill:fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 330.74892,348.21342 -10.44405,20.46194 20.46195,-10.44405 -2.23059,-7.78731 z"></path>
                    </g>
                </svg>
            </div>
        ';
        $html .= '</div>';

        return $html;
    }


    //INPUT TYPE SAISON
    public static function saisons($options)
    {
        $label = (isset($options['label'])) ? $options['label'] : 'Saisons';
        $value = (isset($options['value'])) ? $options['value'] : ['summer' => 0, 'autumn' => 0, 'winter' => 0, 'spring' => 0];
        $col = (isset($options['col'])) ? $options['col'] : 12;
        $seasontable_type = $options['seasontable_type'];
        $seasontable_id = $options['seasontable_id'];


        $html = '<div class="col s12 m' . $col . '"><label>' . $label . '</label>';
        $html .= '<input class="input-data" type="hidden" name="seasontable_type" value="' . $seasontable_type . '">';
        $html .= '<input class="input-data" type="hidden" name="seasontable_id" value="' . $seasontable_id . '">';
        $html .= '<input class="hidden_season_input input-data" id="hidden_summer" type="hidden" name="summer" value="' . $value['summer'] . '">';
        $html .= '<input class="hidden_season_input input-data" id="hidden_autumn" type="hidden" name="autumn" value="' . $value['autumn'] . '">';
        $html .= '<input class="hidden_season_input input-data" id="hidden_winter" type="hidden" name="winter" value="' . $value['winter'] . '">';
        $html .= '<input class="hidden_season_input input-data" id="hidden_spring" type="hidden" name="spring" value="' . $value['spring'] . '">';

        $html .= '
            <div class="season-input row">
                <div class="col s6">
                    <p onclick="switchSaison(\'hidden_summer\')">
                        <svg version="1.1" viewBox="0 0 24.999991 24.999999" height="7.0555553mm" width="7.055553mm">
                            <g transform="translate(-253.62697,-533.73525)">
                                <path style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 266.15215,533.73525 -2.49553,3.34322 -3.69292,-1.39604 -0.64907,3.94192 -3.8412,0.54834 1.24776,3.59222 -3.09422,2.74451 3.09422,2.39481 -1.4464,3.59501 4.03984,0.84769 0.64907,3.69293 3.69292,-1.29812 2.24653,2.99351 2.59345,-2.94315 3.89436,1.24776 0.54834,-3.79365 3.64256,-0.64906 -1.14704,-3.74048 3.19214,-2.24653 -3.2425,-2.84523 1.39604,-3.44114 -3.74049,-0.55114 -0.5987,-4.14056 -3.844,1.4464 -2.44516,-3.34322 z m -0.0419,4.328 a 8.2632674,8.2632674 0 0 1 8.26153,8.26153 8.2632674,8.2632674 0 0 1 -8.26153,8.26432 8.2632674,8.2632674 0 0 1 -8.26432,-8.26432 8.2632674,8.2632674 0 0 1 8.26432,-8.26153 z m 0,1.14705 a 7.1155426,7.1155426 0 0 0 -7.11728,7.11448 7.1155426,7.1155426 0 0 0 7.11728,7.11727 7.1155426,7.1155426 0 0 0 7.11448,-7.11727 7.1155426,7.1155426 0 0 0 -7.11448,-7.11448 z"></path>
                            </g>
                        </svg> 
                        Été
                    </p>
                    <p onclick="switchSaison(\'hidden_autumn\')">
                        <svg version="1.1" viewBox="0 0 25.89868 24.999999" height="7.0555553mm" width="7.3091831mm">
                            <g transform="translate(-378.28044,-439.36014)">
                                <path style="opacity:1;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 397.74521,464.36014 c 0.27167,-0.51062 0.24438,-1.02124 0.0818,-1.53186 -2.66948,0.0151 -3.05407,-1.99346 -3.92157,-3.57435 1.17395,0.51622 2.39626,0.87774 3.83987,0.53105 0.94308,-1.4991 2.27711,-2.8449 5.96405,-3.26798 -1.48418,-0.78978 -2.82675,-1.91616 -2.65524,-3.43137 0.16923,-1.49504 1.69741,-2.46467 3.125,-3.34967 -0.62803,-0.47239 -1.47844,-0.59204 -1.77696,-1.61356 -0.38102,-1.3039 0.28864,-2.628 0.8987,-3.942 -2.41053,1.5492 -4.77649,3.87511 -7.35294,3.67647 -2.23861,-0.17259 -0.95416,-3.85898 -1.30719,-5.88235 -1.04168,0.41208 -2.1091,0.78291 -3.125,0.55147 -1.57763,-0.3594 -1.9268,-2.00704 -2.69608,-3.16585 -0.17792,1.30462 0.0817,2.84678 -0.87827,3.79902 -0.98016,0.97224 -2.26034,0.82728 -3.39052,1.18464 1.0126,1.47039 2.58284,2.78652 2.36929,4.92239 -0.25331,2.53354 -5.74319,0.60138 -8.63971,0.87826 2.83012,2.34983 2.71656,3.85285 1.59313,5.06536 3.71006,0.76312 5.57929,2.34245 3.5335,5.65768 2.24508,-0.31162 4.47249,-0.89689 6.82189,0.4085 0.90551,-0.34462 1.811,-0.63656 2.71651,-1.61356 0.0882,2.18899 1.17198,3.79514 3.49264,4.67728 z"></path>
                            </g>
                        </svg> 
                        Automne
                    </p>
                </div>
                <div class="col s6">
                    <p onclick="switchSaison(\'hidden_winter\')">
                        <svg version="1.1" viewBox="0 0 22.150363 24.999997" height="7.0555549mm" width="6.2513247mm">
                            <g transform="translate(-451.64934,-436.50304)">
                                <path style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 462.77611,436.50314 c -0.74131,-0.008 -1.48189,0.4427 -1.48186,1.37581 l 0,2.22423 -1.58505,-1.25257 c -1.27596,-1.00843 -2.54765,0.91269 -1.43314,1.76276 l 3.01819,2.30162 0,3.48826 -3.09845,-1.78569 -0.58758,-3.73476 c -0.10552,-0.66909 -0.65866,-0.96298 -1.17231,-0.90287 -0.51364,0.0601 -0.98805,0.47483 -0.93153,1.22389 l 0.14617,1.94334 -1.79144,-1.03472 c -1.56138,-0.90147 -3.10094,1.6351 -1.48473,2.56818 l 1.92614,1.11211 -1.8774,0.74523 c -1.51131,0.6008 -0.47939,2.66121 0.81401,2.12105 l 3.49973,-1.4618 3.02392,1.74556 -3.09844,1.78856 -3.52839,-1.35862 c -1.26443,-0.48632 -2.12782,1.33229 -0.77389,1.98347 l 1.75702,0.84555 -1.79428,1.03472 c -1.56139,0.90147 -0.13149,3.50131 1.48473,2.56818 l 1.92614,-1.11211 -0.29237,1.9978 c -0.23535,1.60922 2.06251,1.74851 2.24143,0.35828 l 0.4844,-3.76342 3.02393,-1.74556 0,3.57711 -2.94081,2.37614 c -1.05338,0.85187 0.0891,2.50939 1.32995,1.66244 l 1.61086,-1.10065 0,2.07232 c 0,1.80294 2.96658,1.86626 2.96658,0 l 0,-2.22423 1.58219,1.25256 c 1.27597,1.00843 2.54765,-0.91557 1.43314,-1.76563 l -3.01533,-2.29875 0,-3.49112 3.09559,1.78855 0.58759,3.7319 c 0.21104,1.33818 2.21687,1.17996 2.10384,-0.31816 l -0.14617,-1.9462 1.79429,1.03759 c 1.56138,0.90147 3.09807,-1.63512 1.48186,-2.56819 l -1.92614,-1.11211 1.87742,-0.7481 c 1.51131,-0.6008 0.48229,-2.66121 -0.81115,-2.12104 l -3.50259,1.4618 -3.02393,-1.74556 3.09845,-1.78569 3.52838,1.35575 c 1.26444,0.48632 2.12783,-1.32942 0.7739,-1.9806 l -1.75704,-0.84555 1.7943,-1.03473 c 1.56138,-0.90146 0.13149,-3.50133 -1.48473,-2.56818 l -1.92614,1.11211 0.29236,-2.00065 c 0.23535,-1.60924 -2.0625,-1.74853 -2.24142,-0.35829 l -0.4844,3.76342 -3.02393,1.74556 0,-3.57424 2.94081,-2.37901 c 1.05337,-0.85187 -0.0891,-2.50939 -1.32996,-1.66245 l -1.61085,1.10066 0,-2.06945 c 0,-0.90147 -0.74055,-1.36791 -1.48187,-1.37581 z"></path>
                            </g>
                        </svg> 
                        Hiver
                    </p>
                    
                    <p onclick="switchSaison(\'hidden_spring\')">
                        <svg version="1.1" viewBox="0 0 19.96755 24.999999" height="7.0555553mm" width="5.6352863mm">
                            <g transform="translate(-257.30034,-422.21728)">
                                <path style="opacity:1;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 267.29222,422.21728 c -3.31373,2.24388 -2.69156,5.03736 -1.85776,7.86101 -2.492,-2.20482 -5.14342,-3.04384 -8.13412,-0.98702 0.96818,3.8544 3.70193,4.25822 6.49539,4.55111 -2.98491,1.42929 -3.23879,4.05202 -3.03407,6.87398 2.21231,-0.37767 4.47004,-0.53745 6.15468,-3.3775 l 0,7.38507 c -2.47245,-2.31509 -3.48157,-2.15872 -4.68902,-2.33639 0.79874,1.66899 2.09881,2.96354 4.70795,3.27474 l -0.0676,1.755 1.12494,0 0,-1.65495 c 2.09833,-0.51248 3.81899,-1.38715 4.38074,-3.39102 -1.44951,0.28274 -2.89878,0.36766 -4.34829,2.18226 l 0,-7.19578 c 1.15446,2.13703 2.92494,3.46815 5.8491,3.29097 0.21947,-4.30513 -1.18048,-5.79634 -2.84748,-6.82261 3.75822,-0.16722 5.42658,-1.97424 6.24121,-4.45105 -3.42152,-2.3782 -5.72691,-1.01558 -7.89345,0.81936 0.58002,-2.88822 1.15522,-5.77673 -2.08221,-7.77718 z m 0.0973,9.1536 a 1.6399296,1.6399296 0 0 1 1.64143,1.63872 1.6399296,1.6399296 0 0 1 -1.64143,1.63872 1.6399296,1.6399296 0 0 1 -1.63871,-1.63872 1.6399296,1.6399296 0 0 1 1.63871,-1.63872 z"></path>
                            </g>
                        </svg>
                        Printemps
                    </p>
                </div>
            </div>
        ';
        $html .= '</div>';

        return $html;
    }


    //INPUT TYPE LOCALISATION SUR UNE CARTE
    public static function localisation($options)
    {
        $label = (isset($options['label'])) ? $options['label'] : 'Localisation';
        $lat = (isset($options['lat'])) ? $options['lat'] : 0;
        $lng = (isset($options['lng'])) ? $options['lng'] : 0;
        $withRayon = (isset($options['withRayon'])) ? true : false;
        $rayon = (isset($options['rayon'])) ? $options['rayon'] : 5;

        if ($withRayon) {
            $html = '
            <div class="input-field col s12">
                <input onkeyup="changeRayonPopupMap()" placeholder="rayon en Km" id="rayon-localisation-popup" value="' . $rayon . '" name="rayon" type="number" min="1" max="40" class="input-data">
                <label for="rayon-localisation-popup">Mon rayon d\'action autour de ce point (en km)</label>
            </div>
            ';
        } else {
            $html = '';
        }

        return '
            <div class="row">
                <div class="col s12">
                    <input id="lat-hidden-input" class="input-data" type="hidden" name="lat" value="' . $lat . '">
                    <input id="lng-hidden-input" class="input-data" type="hidden" name="lng" value="' . $lng . '">
                    
                    <label>' . $label . '</label>
                    <div id="input-map" class="input-map"></div>
                </div>
                ' . $html . '
            </div>
        ';
    }


    //INPUT TYPE MARCHE D'APPROCHE
    public static function approach($options)
    {
        $label = (isset($options['label'])) ? $options['label'] : 'La marche d\'approche';
        $polyline = (isset($options['polyline'])) ? $options['polyline'] : '[]';
        $length = (isset($options['length'])) ? $options['length'] : 0;
        $elementsForMap = (isset($options['elements'])) ? $options['elements'] : '';

        return '
            <div class="row">
                <div class="col s12">
                    <input id="polyline-hidden-input" class="input-data" type="hidden" name="polyline" value="' . $polyline . '">
                    <input id="length-hidden-input" class="input-data" type="hidden" name="length" value="' . $length . '">
                    <label>' . $label . '</label>
                    <ul class="ul-tuto-marche-approche">
                        <li>Glisser déposer les points blancs pour changer le tracé</li>
                        <li>Un clic sur un point semi-opaque ajout le point au tracé</li>
                        <li>Un clic sur un point blanc supprime le point du tracé</li>
                        <li>Un clic sur la carte ajout un point au bout du tracé</li>
                    </ul>
                    <div id="input-map-approach" class="input-map input-map-approach"></div>
                    <textarea style="display: none;" id="over-elements-for-map" name="over-element">' . $elementsForMap . '</textarea>
                </div>
            </div>
        ';
    }


    //INPUT DU TYPE LISTE DES SECTORS
    public static function sectors($options)
    {
        $Sector = Sector::class;

        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $col = (isset($options['col'])) ? $options['col'] : '';
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Sectors = $Sector::where('crag_id', $options['crag_id'])->get();

        $html = '
            <div class="input-field col s12 ' . $col . '">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Sectors as $sector) {
            $selected = ($sector->id == $value) ? 'selected' : '';
            $html .= '<option ' . $selected . ' value="' . $sector->id . '">' . ucfirst($sector->label) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }

    // GYM SECTORS LIST
    public static function roomSectors($options)
    {
        $Sector = GymSector::class;

        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $col = (isset($options['col'])) ? $options['col'] : '';
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Sectors = $Sector::where('room_id', $options['room_id'])->get();

        $html = '
            <div class="input-field col s12 ' . $col . '">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Sectors as $sector) {
            $selected = ($sector->id == $value) ? 'selected' : '';
            $html .= '<option ' . $selected . ' value="' . $sector->id . '">' . ucfirst($sector->label) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }

    //COTATION
    public static function cotation($options)
    {
        $grade = (isset($options['grade'])) ? $options['grade'] : 2;
        $col = (isset($options['col'])) ? $options['col'] : 's12 m6 l8';
        $name = (isset($options['name'])) ? $options['name'] : 'grade';
        $label = (isset($options['label'])) ? $options['label'] : '<label>Cotation</label>';
        $icon = (isset($options['icon'])) ? $options['icon'] : '<i class="oblyk-icon icon-cotation prefix"></i>';
        $cat_grades = [
            'Cotation Française' => [
                '2', '2a', '2b', '2c',
                '3', '3a', '3b', '3c',
                '4', '4a', '4b', '4c',
                '5', '5a', '5b', '5c',
                '6', '6a', '6b', '6c',
                '7', '7a', '7b', '7c',
                '8', '8a', '8b', '8c',
                '9', '9a', '9b', '9c',
            ],
            'Projet' => [
                '?'
            ],
            'Grande voie' => [
                'PD', 'AD', 'D', 'TD', 'ED', 'ABO'
            ],
            'Peak District / Annot' => [
                'B0', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8', 'B9', 'B10', 'B11', 'B12', 'B13', 'B14', 'B15', 'B16', 'B17', 'B18', 'B19', 'B20'
            ],
            'USA Bloc' => [
                'VB', 'V0', 'V1', 'V2', 'V3', 'V4', 'V5', 'V6', 'V7', 'V8', 'V9', 'V10', 'V11', 'V12', 'V13', 'V14', 'V15', 'V16', 'V17', 'V18', 'V19', 'V20'
            ],
            'USA Voie' => [
                '5.1', '5.2', '5.3', '5.4', '5.5', '5.6', '5.7', '5.8', '5.9',
                '5.10a', '5.10b', '5.10c', '5.10d',
                '5.11a', '5.11b', '5.11c', '5.11d',
                '5.12a', '5.12b', '5.12c', '5.12d',
                '5.13a', '5.13b', '5.13c', '5.13d',
                '5.14a', '5.14b', '5.14c', '5.14d',
                '5.15a', '5.15b', '5.15c', '5.15d',
            ],
            'Angleterre' => [
                'M', 'D', 'VD', 'S', 'HS', 'VS', 'HVS',
                'E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7', 'E8', 'E9', 'E10', 'E11',
            ],
            'UIAA' => [
                'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'
            ],
            'Artificiel' => [
                'A0', 'A1', 'A2', 'A3', 'A4', 'A5', 'A6',
            ],
            'Entre cotation' => [
                '2/3', '3/4', '4/5', '5/6', '6/7', '7/8', '8/9',
                '2c+/3a', '3c+/4a', '4c+/5a', '5c+/6a', '6c+/7a', '7c+/8a', '8c+/9a'
            ]
        ];

        $html = '
            <div class="input-field col ' . $col . ' condense-select">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">';

        foreach ($cat_grades as $key => $cotations) {
            $html .= '<optgroup label="' . $key . '">';

            foreach ($cotations as $cotation) {
                $selected = ($cotation == $grade) ? 'selected' : '';
                $html .= '<option ' . $selected . ' value="' . $cotation . '">' . $cotation . '</option>';
            }

            $html .= '</optgroup>';
        }

        $html .=
            '</select>
                ' . $label . '
            </div>
        ';

        return $html;
    }


    //PONDERATION
    public static function ponderation($options)
    {
        $sub_grade = (isset($options['sub_grade'])) ? $options['sub_grade'] : '';
        $sub_grades = ['', '+', '-', '/+', '/-', '+/b', '+/c', '?', '+/?', '-/?'];
        $col = (isset($options['col'])) ? $options['col'] : 's12 m6 l4';
        $name = (isset($options['name'])) ? $options['name'] : 'sub_grade';
        $label = (isset($options['label'])) ? $options['label'] : '<label>Pondération</label>';
        $icon = (isset($options['icon'])) ? $options['icon'] : '<i class="oblyk-icon icon-ponderation prefix"></i>';

        $html =
            '
            <div class="input-field col ' . $col . ' condense-select">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">';

        foreach ($sub_grades as $sub) {
            $selected = ($sub == $sub_grade) ? 'selected' : '';
            $html .= '<option ' . $selected . ' value="' . $sub . '">' . $sub . '</option>';
        }

        $html .=
            '</select>
                ' . $label . '
            </div>
        ';

        return $html;
    }


    //NOUVELLE FONCTION POUR LES COTATIONS ET PONDERATION
    public static function grade($options)
    {
        $name = $options['name'];
        $id = (isset($options['id'])) ? $options['id'] : $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : '';
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';
        $placeholder = (isset($options['placeholder'])) ? $options['placeholder'] : '';

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <input placeholder="' . $placeholder . '" name="' . $name . '" value="' . $value . '" type="text" id="' . $id . '" class="input-data">
                <label for="' . $id . '">' . $label . '</label>
            </div>
        ';

        return $html;
    }


    //INCLINAISON DE LA LIGNE
    public static function inclinaison($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Inclines = Incline::all();

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Inclines as $key => $incline) {
            $selected = ($incline->id == $value) ? 'selected' : '';
            $html .= '<option class="left" data-icon="/img/incline-' . ($key + 1) . '.png" ' . $selected . ' value="' . $incline->id . '">' . trans('elements/inclines.incline_' . $incline->id) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }

    //RÉSEAUX SOCIAUX
    public static function social($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Socials = SocialNetwork::all();

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Socials as $key => $social) {
            $selected = ($social->id == $value) ? 'selected' : '';
            $html .= '<option class="left" data-icon="/img/social-' . $social->id . '.svg" ' . $selected . ' value="' . $social->id . '">' . ucfirst($social->label) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }


    //TYPE DE POINT
    public static function point($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? '<label>' . $options['label'] . '</label>' : '';
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Points = Point::all();

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Points as $key => $point) {
            $selected = ($point->id == $value) ? 'selected' : '';
            $html .= '<option class="left" data-icon="/img/point-' . ($key + 1) . '.png" ' . $selected . ' value="' . $point->id . '">' . trans('elements/points.point_' . $point->id) . '</option>';
        }

        $html .= '
                </select>
                ' . $label . '
            </div>
        ';

        return $html;
    }

    //TYPE DE RELAIS
    public static function relais($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? '<label>' . $options['label'] . '</label>' : '';
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Anchors = Anchor::all();

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Anchors as $key => $anchor) {
            $selected = ($anchor->id == $value) ? 'selected' : '';
            $html .= '<option class="left" data-icon="/img/relais-' . ($key + 1) . '.png" ' . $selected . ' value="' . $anchor->id . '">' . trans('elements/anchors.anchor_' . $anchor->id) . '</option>';
        }

        $html .= '
                </select>
                ' . $label . '
            </div>
        ';

        return $html;
    }


    //TYPE DE RÉCEPTION
    public static function reception($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Receptions = Reception::all();

        $html = '
            <div class="input-field col s12 condense-select">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Receptions as $reception) {
            $selected = ($reception->id == $value) ? 'selected' : '';
            $html .= '<option ' . $selected . ' value="' . $reception->id . '">' . trans('elements/receptions.reception_' . $reception->id) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }


    //TYPE DE DÉPART
    public static function start($options)
    {
        $name = $options['name'];
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : 1;
        $icon = (isset($options['icon'])) ? '<i class="oblyk-icon ' . $options['icon'] . ' prefix"></i>' : '';

        $Starts = Start::all();

        $html = '
            <div class="input-field col s12">
                ' . $icon . '
                <select class="input-data" name="' . $name . '">
        ';

        foreach ($Starts as $key => $start) {
            $selected = ($start->id == $value) ? 'selected' : '';
            $html .= '<option class="left" data-icon="/img/start-' . ($key + 1) . '.png" ' . $selected . ' value="' . $start->id . '">' . trans('elements/starts.start_' . $start->id) . '</option>';
        }

        $html .= '
                </select>
                <label>' . $label . '</label>
            </div>
        ';

        return $html;
    }

    //INPUT DU COLOR
    public static function color($options)
    {
        $name = $options['name'];
        $value = (isset($options['value'])) ? $options['value'] : '';
        $label = (isset($options['label'])) ? $options['label'] : $options['name'];
        $placeholder = (isset($options['placeholder'])) ? $options['placeholder'] : '';
        $id = (isset($options['id'])) ? $options['id'] : $options['name'];
        $classLabel = (isset($options['classLabel'])) ? $options['classLabel'] : '';
        $onkeyup = (isset($options['onkeyup'])) ? ' onkeyup="' . $options['onkeyup'] . '"' : '';

        return '
            <div class="col s12">
                <input ' . $onkeyup . ' placeholder="' . $placeholder . '" value="' . $value . '" id="' . $id . '" name="' . $name . '" type="color" class="input-data">
                <label class="' . $classLabel . '" for="' . $id . '">' . $label . '</label>
            </div>
        ';
    }
}

<?php

namespace App\Lib;

use App\Album;
use App\Anchor;
use App\Climb;
use App\CrossHardness;
use App\CrossMode;
use App\CrossStatus;
use App\ForumGeneralCategory;
use App\GymGrade;
use App\GymGradeLine;
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
            'required' => $options['required'] ?? false,
            'value' => $value,
            'class' => (isset($options['class'])) ? $options['class'] : '',
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
            'col' => $options['col'] ?? 's12',
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

    // Rocks <select>
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

    // Gym route type <select>
    public static function gymRoutesTypes($options)
    {
        return view('inputs.gym-route-type', [
            'name' => $options['name'],
            'class' => (isset($options['class'])) ? $options['class'] : '',
            'col' => $options['col'] ?? 's12',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
        ]);
    }

    // Cross status <select>
    public static function crossStatuses($options)
    {
        return view('inputs.cross-statuses', [
            'name' => $options['name'],
            'col' => $options['col'] ?? 's12',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'statuses' => CrossStatus::all(),
        ]);
    }

    // Hardness cross <select>
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

    // Cross modes <select>
    public static function crossModes($options)
    {
        return view('inputs.cross-modes', [
            'name' => $options['name'],
            'class' => (isset($options['class'])) ? $options['class'] : '',
            'col' => $options['col'] ?? 's12',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'modes' => CrossMode::all(),
        ]);
    }

    // Forum category <select>
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

    // Sex <select>
    public static function sex($options)
    {
        return view('inputs.sex', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 0,
            'icon' => $options['icon'] ?? '',
        ]);
    }

    // Climbs <select>
    public static function climbs($options)
    {
        return view('inputs.climbs', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'col' => $options['col'] ?? '',
            'icon' => $options['icon'] ?? '',
            'climbs' => Climb::all(),
        ]);
    }

    // Notes <select>
    public static function note($options)
    {
        return view('inputs.notes', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
        ]);
    }

    // Suns <select>
    public static function suns($options)
    {
        return view('inputs.suns', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'suns' => Sun::all(),
        ]);
    }

    // Rains <select>
    public static function rains($options)
    {
        return view('inputs.rains', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'rains' => RainExposure::all(),
        ]);
    }

    // Orientations compass
    public static function orientations($options)
    {
        return view('inputs.orientations', [
            'label' => (isset($options['label'])) ? $options['label'] : 'Orientations',
            'value' => (isset($options['value'])) ? $options['value'] : ['north' => 0, 'south' => 0, 'east' => 0, 'west' => 0, 'north_east' => 0, 'north_west' => 0, 'south_east' => 0, 'south_west' => 0],
            'col' => (isset($options['col'])) ? $options['col'] : 12,
            'orientable_type' => $options['orientable_type'],
            'orientable_id' => $options['orientable_id'],
        ]);
    }

    // Seasons icons
    public static function seasons($options)
    {
        return view('inputs.seasons', [
            'label' => (isset($options['label'])) ? $options['label'] : 'Saisons',
            'value' => (isset($options['value'])) ? $options['value'] : ['summer' => 0, 'autumn' => 0, 'winter' => 0, 'spring' => 0],
            'col' => (isset($options['col'])) ? $options['col'] : 12,
            'seasontable_type' => $options['seasontable_type'],
            'seasontable_id' => $options['seasontable_id'],
        ]);
    }

    // Localisation map
    public static function localisation($options)
    {
        return view('inputs.localisation', [
            'label' => (isset($options['label'])) ? $options['label'] : 'Localisation',
            'lat' => (isset($options['lat'])) ? $options['lat'] : 0,
            'lng' => (isset($options['lng'])) ? $options['lng'] : 0,
            'withRayon' => (isset($options['withRayon'])),
            'rayon' => (isset($options['rayon'])) ? $options['rayon'] : 5,
        ]);
    }

    // Approach map
    public static function approach($options)
    {
        return view('inputs.approach', [
            'label' => (isset($options['label'])) ? $options['label'] : 'La marche d\'approche',
            'polyline' => (isset($options['polyline'])) ? $options['polyline'] : '[]',
            'length' => (isset($options['length'])) ? $options['length'] : 0,
            'elementsForMap' => $options['elements'] ?? '',
        ]);
    }

    // Crag sectors <select>
    public static function sectors($options)
    {
        $Sector = Sector::class;

        return view('inputs.sectors', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'col' => $options['col'] ?? '',
            'icon' => $options['icon'] ?? '',
            'sectors' => $Sector::where('crag_id', $options['crag_id'])->get(),
        ]);
    }

    // Gym room sectors <select>
    public static function roomSectors($options)
    {
        return view('inputs.room-sectors', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'col' => $options['col'] ?? 's12',
            'icon' => $options['icon'] ?? '',
            'sectors' => GymSector::where('room_id', $options['room_id'])->get(),
        ]);
    }

    // Gym difficulty system <select>
    public static function difficultySystems($options)
    {
        return view('inputs.difficulty-systems', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'col' => $options['col'] ?? 's12',
            'icon' => $options['icon'] ?? '',
        ]);
    }

    // Grade and balancing
    public static function grade($options)
    {
        return view('inputs.grade', [
            'name' => $options['name'],
            'col' => $options['col'] ?? 's12',
            'required' => $options['required'] ?? false,
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => $options['value'] ?? '',
            'classLabel' => ($options['value'] != '' || $options['placeholder'] != '') ? 'active' : '',
            'class' => (isset($options['class'])) ? $options['class'] : '',
            'icon' => $options['icon'] ?? '',
            'placeholder' => $options['placeholder'] ?? '',
        ]);
    }

    // Inclines <select>
    public static function inclines($options)
    {
        return view('inputs.inclines', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'inclines' => Incline::all(),
        ]);
    }

    // Social network <select>
    public static function social($options)
    {
        return view('inputs.social', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'socials' => SocialNetwork::all(),
        ]);
    }

    // Points <select>
    public static function point($options)
    {
        return view('inputs.point', [
            'name' => $options['name'],
            'label' => $options['label'] ?? '',
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'points' => Point::all(),
        ]);
    }

    // Anchors <select>
    public static function anchors($options)
    {
        return view('inputs.anchors', [
            'name' => $options['name'],
            'label' => $options['label'] ?? '',
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'anchors' => Anchor::all(),
        ]);
    }

    // Receptions <select>
    public static function reception($options)
    {
        return view('inputs.receptions', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'receptions' => Reception::all(),
        ]);
    }

    // Starts <select>
    public static function start($options)
    {
        return view('inputs.starts', [
            'name' => $options['name'],
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'value' => (isset($options['value'])) ? $options['value'] : 1,
            'icon' => $options['icon'] ?? '',
            'starts' => Start::all(),
        ]);
    }

    // Color picker
    public static function color($options)
    {
        return view('inputs.color', [
            'name' => $options['name'],
            'value' => $options['value'] ?? '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'placeholder' => $options['placeholder'] ?? '',
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'classLabel' => $options['classLabel'] ?? '',
            'onkeyup' => (isset($options['onkeyup'])) ? ' onkeyup="' . $options['onkeyup'] . '"' : '',
        ]);
    }

    // Color list <select>
    public static function colorList($options)
    {
        $Color = new Color();

        return view('inputs.color-list', [
            'name' => $options['name'],
            'value' => $options['value'] ?? '',
            'required' => $options['required'] ?? false,
            'icon' => $options['icon'] ?? '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'placeholder' => $options['placeholder'] ?? '',
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'classLabel' => $options['classLabel'] ?? '',
            'onChange' => $options['onChange'] ?? '',
            'colors' => $Color->holdColors,
            'col' => $options['col'] ?? 's12',
        ]);
    }

    // Gym grade <select>
    public static function gymGrade($options)
    {
        return view('inputs.gym-grade', [
            'name' => $options['name'],
            'value' => $options['value'] ?? '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'placeholder' => $options['placeholder'] ?? '',
            'icon' => $options['icon'] ?? '',
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'classLabel' => $options['classLabel'] ?? '',
        ]);
    }

    // List of grade system <select>
    public static function gymGradesSystem($options) {
        $GymGrade = GymGrade::class;
        $grades = $GymGrade::where('gym_id', $options['gym_id'])->get();

        return view('inputs.gym-grades-system', [
            'name' => $options['name'],
            'required' => $options['required'] ?? false,
            'value' => $options['value'] ?? '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'placeholder' => $options['placeholder'] ?? '',
            'icon' => $options['icon'] ?? '',
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'onChange' => $options['onChange'] ?? '',
            'grades' => $grades,
        ]);
    }

    // List of level in grade system <select>
    public static function gymLevelGrade($options) {
        $GymGradeLine = GymGradeLine::class;
        $gradeLines = $GymGradeLine::where('gym_grade_id', $options['gym_grade_id'])->orderBy('order')->get();

        return view('inputs.gym-grade-lines', [
            'name' => $options['name'],
            'required' => $options['required'] ?? false,
            'value' => $options['value'] ?? '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'placeholder' => $options['placeholder'] ?? '',
            'icon' => $options['icon'] ?? '',
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'onChange' => $options['onChange'] ?? '',
            'gradeLines' => $gradeLines,
            'col' => (isset($options['col'])) ? $options['col'] : 's12',
            'class' => (isset($options['class'])) ? $options['class'] : ''
        ]);
    }

    // List of grade system <select>
    public static function pitchesVariant($options) {
        return view('inputs.pitches-variant', [
            'name' => $options['name'],
            'required' => $options['required'] ?? false,
            'value' => $options['value'] ?? '',
            'label' => (isset($options['label'])) ? $options['label'] : $options['name'],
            'placeholder' => $options['placeholder'] ?? '',
            'icon' => $options['icon'] ?? '',
            'id' => (isset($options['id'])) ? $options['id'] : $options['name'],
            'onChange' => $options['onChange'] ?? '',
            'pitches' => $options['pitches'],
        ]);
    }
}

@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_grade'),
    'meta_description'=>trans('meta/tools.description_grade'),
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
    ])

@section('css')
    <link href="/css/project.css" rel="stylesheet">
@endsection


@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/grade.title')</h1>

                <p>
                    @lang('pages/tools/grade.para_1')
                </p>

                <p>
                    @lang('pages/tools/grade.para_2')
                </p>

                <p>
                    @lang('pages/tools/grade.para_3')
                </p>

                <ul class="oblyk-ul">
                    <li><strong>+</strong> : @lang('pages/tools/grade.li1') <span class="grey-text">(@lang('pages/tools/grade.example') : 6a+)</span></li>
                    <li><strong>-</strong> : @lang('pages/tools/grade.li2') <span class="grey-text">(@lang('pages/tools/grade.example') : 6a-)</span></li>
                    <li><strong>/+</strong> : @lang('pages/tools/grade.li3') <span class="grey-text">(@lang('pages/tools/grade.example') : 6a/+)</span></li>
                    <li><strong>/-</strong> : @lang('pages/tools/grade.li4') <span class="grey-text">(@lang('pages/tools/grade.example') : 6a/-)</span></li>
                    <li><strong>?</strong> : @lang('pages/tools/grade.li5') <span class="grey-text">(@lang('pages/tools/grade.example') : 8b?)</span></li>
                    <li><strong>+/b</strong> : @lang('pages/tools/grade.li6') <span class="grey-text">(@lang('pages/tools/grade.example') : 6a+/b)</span></li>
                    <li><strong>+/c</strong> : @lang('pages/tools/grade.li7') <span class="grey-text">(@lang('pages/tools/grade.example') : 6b+/c)</span></li>
                </ul>

                <table class="centered highlight">
                    <thead>
                        <tr>
                            <th>@lang('pages/tools/grade.columnN')</th>
                            <th>@lang('pages/tools/grade.columnFr')</th>
                            <th>@lang('pages/tools/grade.columnEn')</th>
                            <th>@lang('pages/tools/grade.columnUSARoute')</th>
                            <th>@lang('pages/tools/grade.columnUSABoulder')</th>
                            <th>@lang('pages/tools/grade.columnDERoute')</th>
                            <th>@lang('pages/tools/grade.columnAnnot')</th>
                            <th>@lang('pages/tools/grade.columnGV')</th>
                            <th>@lang('pages/tools/grade.columnArtif')</th>
                            <th>@lang('pages/tools/grade.columnRGB')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bg-color-grade-1 text-bold">1</td> {{-- numero --}}
                            <td>1a</td> {{-- française --}}
                            <td>M</td> {{-- anglaise --}}
                            <td>5.1</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-1">rgb(255,85,220)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-2 text-bold">2</td> {{-- numero --}}
                            <td>1a+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-2">rgb(246,68,211)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-3 text-bold">3</td> {{-- numero --}}
                            <td>1b</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-3">rgb(238,51,201)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-4 text-bold">4</td> {{-- numero --}}
                            <td>1b+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-4">rgb(229,34,190)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-5 text-bold">5</td> {{-- numero --}}
                            <td>1c</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-5">rgb(221,17,180)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-6 text-bold">6</td> {{-- numero --}}
                            <td>1c+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-6">rgb(212,0,170)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-7 text-bold">7</td> {{-- numero --}}
                            <td>2a</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.2</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>III-</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-7">rgb(134,205,222)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-8 text-bold">8</td> {{-- numero --}}
                            <td>2a+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-8">rgb(119,198,218)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-9 text-bold">9</td> {{-- numero --}}
                            <td>2b</td> {{-- française --}}
                            <td>D</td> {{-- anglaise --}}
                            <td>5.3</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>III</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-9">rgb(103,191,213)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-10 text-bold">10</td> {{-- numero --}}
                            <td>2b+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-10">rgb(87,184,209)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-11 text-bold">11</td> {{-- numero --}}
                            <td>2c</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-11">rgb(71,178,204)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-12 text-bold">12</td> {{-- numero --}}
                            <td>2c+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-12">rgb(55,170,200)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-13 text-bold">13</td> {{-- numero --}}
                            <td>3a</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.4</td> {{-- USA voie --}}
                            <td>VB</td> {{-- USA bloc --}}
                            <td>III+</td> {{-- Allemande --}}
                            <td>B0</td> {{-- Annot --}}
                            <td>PD</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-13">rgb(255,221,84)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-14 text-bold">14</td> {{-- numero --}}
                            <td>3a+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td>V0-</td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-14">rgb(252,215,68)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-15 text-bold">15</td> {{-- numero --}}
                            <td>3b</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.5</td> {{-- USA voie --}}
                            <td>V0</td> {{-- USA bloc --}}
                            <td>IV-</td> {{-- Allemande --}}
                            <td>B1</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-15">rgb(249,208,51)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-16 text-bold">16</td> {{-- numero --}}
                            <td>3b+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td>A0</td> {{-- Artif --}}
                            <td class="color-grade-16">rgb(246,202,34)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-17 text-bold">17</td> {{-- numero --}}
                            <td>3c</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td>V0+</td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td>B2</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-17">rgb(243,195,17)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-18 text-bold">18</td> {{-- numero --}}
                            <td>3c+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-18">rgb(240,189,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-19 text-bold">19</td> {{-- numero --}}
                            <td>4a</td> {{-- française --}}
                            <td>VD</td> {{-- anglaise --}}
                            <td>5.6</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>IV</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>AD-</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-19">rgb(255,127,42)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-20 text-bold">20</td> {{-- numero --}}
                            <td>4a+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-20">rgb(246,119,34)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-21 text-bold">21</td> {{-- numero --}}
                            <td>4b</td> {{-- française --}}
                            <td>S</td> {{-- anglaise --}}
                            <td>5.7</td> {{-- USA voie --}}
                            <td>V1</td> {{-- USA bloc --}}
                            <td>IV+</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>AD</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-21">rgb(238,110,25)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-22 text-bold">22</td> {{-- numero --}}
                            <td>4b+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td>A1</td> {{-- Artif --}}
                            <td class="color-grade-22">rgb(229,102,17)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-23 text-bold">23</td> {{-- numero --}}
                            <td>4c</td> {{-- française --}}
                            <td>HS</td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td>V2</td> {{-- USA bloc --}}
                            <td>V-</td> {{-- Allemande --}}
                            <td>B3</td> {{-- Annot --}}
                            <td>AD+</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-23">rgb(221,93,8)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-24 text-bold">24</td> {{-- numero --}}
                            <td>4c+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>V</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-24">rgb(212,85,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-25 text-bold">25</td> {{-- numero --}}
                            <td>5a</td> {{-- française --}}
                            <td>VS</td> {{-- anglaise --}}
                            <td>5.8</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>V+</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>D-</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-25">rgb(170,212,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-26 text-bold">26</td> {{-- numero --}}
                            <td>5a+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-26">rgb(156,195,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-27 text-bold">27</td> {{-- numero --}}
                            <td>5b</td> {{-- française --}}
                            <td>HVS</td> {{-- anglaise --}}
                            <td>5.9</td> {{-- USA voie --}}
                            <td>V3</td> {{-- USA bloc --}}
                            <td>VI-</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>D</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-27">rgb(143,178,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-28 text-bold">28</td> {{-- numero --}}
                            <td>5b+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td>A2</td> {{-- Artif --}}
                            <td class="color-grade-28">rgb(129,161,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-29 text-bold">29</td> {{-- numero --}}
                            <td>5c</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.10a</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>VI</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>D+</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-29">rgb(115,144,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-30 text-bold">30</td> {{-- numero --}}
                            <td>5c+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-30">rgb(102,128,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-31 text-bold">31</td> {{-- numero --}}
                            <td>6a</td> {{-- française --}}
                            <td>E1</td> {{-- anglaise --}}
                            <td>5.10b</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>VI+</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>TD-</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-31">rgb(0,85,212)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-32 text-bold">32</td> {{-- numero --}}
                            <td>6a+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.10c</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>VII-</td> {{-- Allemande --}}
                            <td>B4</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-32">rgb(0,75,186)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-33 text-bold">33</td> {{-- numero --}}
                            <td>6b</td> {{-- française --}}
                            <td>E2</td> {{-- anglaise --}}
                            <td>5.10d</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>VII</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>TD</td> {{-- Grande-voie --}}
                            <td>A3</td> {{-- Artif --}}
                            <td class="color-grade-33">rgb(0,64,161)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-34 text-bold white-text">34</td> {{-- numero --}}
                            <td>6b+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.11a</td> {{-- USA voie --}}
                            <td>V4</td> {{-- USA bloc --}}
                            <td>VII+</td> {{-- Allemande --}}
                            <td>B5</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-34">rgb(0,55,136)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-35 text-bold white-text">35</td> {{-- numero --}}
                            <td>6c</td> {{-- française --}}
                            <td>E3</td> {{-- anglaise --}}
                            <td>5.11b</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>VIII-</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td>TD+</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-35">rgb(0,44,110)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-36 text-bold white-text">36</td> {{-- numero --}}
                            <td>6c+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.11c</td> {{-- USA voie --}}
                            <td>V5</td> {{-- USA bloc --}}
                            <td>VIII</td> {{-- Allemande --}}
                            <td>B6</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-36">rgb(0,34,85)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-37 text-bold">37</td> {{-- numero --}}
                            <td>7a</td> {{-- française --}}
                            <td>E4</td> {{-- anglaise --}}
                            <td>5.11d</td> {{-- USA voie --}}
                            <td>V6</td> {{-- USA bloc --}}
                            <td>VIII+</td> {{-- Allemande --}}
                            <td>B7</td> {{-- Annot --}}
                            <td>ED-</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-37">rgb(171,55,200)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-38 text-bold">38</td> {{-- numero --}}
                            <td>7a+</td> {{-- française --}}
                            <td>E5</td> {{-- anglaise --}}
                            <td>5.12a</td> {{-- USA voie --}}
                            <td>V7</td> {{-- USA bloc --}}
                            <td>IX-</td> {{-- Allemande --}}
                            <td>B8</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-38">rgb(157,51,184)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-39 text-bold">39</td> {{-- numero --}}
                            <td>7b</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.12b</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td>B9</td> {{-- Annot --}}
                            <td>ED</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-39">rgb(144,46,168)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-40 text-bold">40</td> {{-- numero --}}
                            <td>7b+</td> {{-- française --}}
                            <td>E6</td> {{-- anglaise --}}
                            <td>5.12c</td> {{-- USA voie --}}
                            <td>V8</td> {{-- USA bloc --}}
                            <td>IX</td> {{-- Allemande --}}
                            <td>B10</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td>A4</td> {{-- Artif --}}
                            <td class="color-grade-40">rgb(130,42,152)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-41 text-bold">41</td> {{-- numero --}}
                            <td>7c</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.12d</td> {{-- USA voie --}}
                            <td>V9</td> {{-- USA bloc --}}
                            <td>IX+</td> {{-- Allemande --}}
                            <td>B11</td> {{-- Annot --}}
                            <td>ED+</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-41">rgb(117,37,136)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-42 text-bold">42</td> {{-- numero --}}
                            <td>7c+</td> {{-- française --}}
                            <td>E7</td> {{-- anglaise --}}
                            <td>5.13a</td> {{-- USA voie --}}
                            <td>V10</td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td>B12</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-42">rgb(103,33,120)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-43 text-bold">43</td> {{-- numero --}}
                            <td>8a</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.13b</td> {{-- USA voie --}}
                            <td>V11</td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td>B13</td> {{-- Annot --}}
                            <td>ABO-</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-43">rgb(255,59,59)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-44 text-bold">44</td> {{-- numero --}}
                            <td>8a+</td> {{-- française --}}
                            <td>E8</td> {{-- anglaise --}}
                            <td>5.13c</td> {{-- USA voie --}}
                            <td>V12</td> {{-- USA bloc --}}
                            <td>X-</td> {{-- Allemande --}}
                            <td>B14</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-44">rgb(255,42,42)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-45 text-bold">45</td> {{-- numero --}}
                            <td>8b</td> {{-- française --}}
                            <td>E9</td> {{-- anglaise --}}
                            <td>5.13d</td> {{-- USA voie --}}
                            <td>V13</td> {{-- USA bloc --}}
                            <td>X</td> {{-- Allemande --}}
                            <td>B15</td> {{-- Annot --}}
                            <td>ABO</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-45">rgb(221,25,25)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-46 text-bold">46</td> {{-- numero --}}
                            <td>8b+</td> {{-- française --}}
                            <td>E10</td> {{-- anglaise --}}
                            <td>5.14a</td> {{-- USA voie --}}
                            <td>V14</td> {{-- USA bloc --}}
                            <td>X+</td> {{-- Allemande --}}
                            <td>B16</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td>A5</td> {{-- Artif --}}
                            <td class="color-grade-46">rgb(204,17,17)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-47 text-bold">47</td> {{-- numero --}}
                            <td>8c</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.14b</td> {{-- USA voie --}}
                            <td>V15</td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td>B17</td> {{-- Annot --}}
                            <td>ABO+</td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-47">rgb(187,8,8)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-48 text-bold">48</td> {{-- numero --}}
                            <td>8c+</td> {{-- française --}}
                            <td>E11</td> {{-- anglaise --}}
                            <td>5.14c</td> {{-- USA voie --}}
                            <td>V16</td> {{-- USA bloc --}}
                            <td>XI-</td> {{-- Allemande --}}
                            <td>B18</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-48">rgb(170,0,0)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-49 text-bold">49</td> {{-- numero --}}
                            <td>9a</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.14d</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>XI</td> {{-- Allemande --}}
                            <td>B19</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-49">rgb(128,128,128)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-50 text-bold">50</td> {{-- numero --}}
                            <td>9a+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.15a</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>XI+</td> {{-- Allemande --}}
                            <td>B20</td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-50">rgb(102,102,102)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-51 text-bold">51</td> {{-- numero --}}
                            <td>9b</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.15b</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>XII-</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-51">rgb(77,77,77)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-52 text-bold white-text">52</td> {{-- numero --}}
                            <td>9b+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.15c</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>XII</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td>A6</td> {{-- Artif --}}
                            <td class="color-grade-52">rgb(51,51,51)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-53 text-bold white-text">53</td> {{-- numero --}}
                            <td>9c</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td>5.15d</td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td>XII+</td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-53">rgb(25,25,25)</td> {{-- RGB --}}
                        </tr>
                        <tr>
                            <td class="bg-color-grade-54 text-bold white-text">54</td> {{-- numero --}}
                            <td>9c+</td> {{-- française --}}
                            <td></td> {{-- anglaise --}}
                            <td></td> {{-- USA voie --}}
                            <td></td> {{-- USA bloc --}}
                            <td></td> {{-- Allemande --}}
                            <td></td> {{-- Annot --}}
                            <td></td> {{-- Grande-voie --}}
                            <td></td> {{-- Artif --}}
                            <td class="color-grade-54">rgb(0,0,0)</td> {{-- RGB --}}
                        </tr>
                    </tbody>
                </table>

                <p class="text-bold text-underline">@lang('pages/tools/grade.bonusTitle')</p>
                <p>@lang('pages/tools/grade.bonusPara')</p>
                <pre>^((([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))(\+|\-|\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c)?|\?)$</pre>
            </div>
        </div>
    </div>

@endsection

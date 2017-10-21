@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_supportUs'),
    'meta_description'=>trans('meta/project.description_supportUs'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/projects/supportUs.title')</h1>

                <div class="row">

                    <div class="col s12 m6">
                        <img src="/img/support-us.svg" alt="un grimpeur qui code dans la forêt" class="infographie-contact">
                    </div>

                    <div class="col s12 m6">
                        <p>
                            @lang('pages/projects/supportUs.para_1')
                        </p>
                        <p class="text-bold">
                            @lang('pages/projects/supportUs.para_2')
                        </p>
                        <p>
                            @lang('pages/projects/supportUs.para_3')
                        </p>
                    </div>
                </div>

                <p>
                    @lang('pages/projects/supportUs.para_4')
                </p>

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="text-center">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="Y5CMUM3UZ7TEQ">
                    <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
                    <img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
                </form>

                <p class="text-center grey-text">
                    @lang('pages/projects/supportUs.thanks')
                </p>
            </div>
        </div>

        {{--<div class="row">--}}
            {{--<h1 class="loved-king-font text-center grey-text text-darken-3">Autre méthode</h1>--}}

            {{--<p>--}}
                {{--Vous aimeriez nous soutenire mais vous n'avez pas vraiment les moyens de le faire ? Nous testons en ce moment une nouvelle méthode ... permettez nous d'utiliser la puissance de votre ordinateur pour générer de la monnaie !<br>--}}
            {{--</p>--}}

            {{--<p>--}}
                {{--C'est très simple ! Désactivez votre bloqueur de pub, cliquez sur <a class="blue-text btn-flat"><i class="material-icons left">play_circle_outline</i> START MINING</a>, laissez cette page ouverte ; )--}}
            {{--</p>--}}
        {{--</div>--}}

        {{--<div>--}}
            {{--<div class="coinhive-miner"--}}
                 {{--style="width: 100%; height: 310px"--}}
                 {{--data-text="#4A96F3"--}}
                 {{--data-action="#4A96F3"--}}
                 {{--data-graph="#FF5722"--}}
                 {{--data-key="cfiX5g0Z65jMdIUwIMsx01LuPWMwSTuU">--}}
                {{--<p class="text-center text-bold">--}}
                    {{--Pour nous aider, désactivez votre bloqueur de pub<br>--}}
                {{--</p>--}}
            {{--</div>--}}

            {{--<p class="grey-text">--}}
                {{--Vous pouvez gérer la puissance que vous nous concédez, les <span>THREADS</span> sont les coeurs de votre ordinateur et le <span>SPEED</span> le poucentage d'utilisation que vous acceptez que nous utilisions sur chacun d'eux.--}}
            {{--</p>--}}

        {{--</div>--}}

    </div>

@endsection

@section('script')
    {{--<script src="https://coinhive.com/lib/miner.min.js" async></script>--}}
@endsection

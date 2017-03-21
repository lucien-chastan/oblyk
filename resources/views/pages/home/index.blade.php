@extends('layouts.app')

@section('css')
    {{--css particulier à la page--}}
    <link href="/css/home.css" rel="stylesheet">
@endsection

@section('content')

    <div class="parallax-container">
        <div class="parallax">
            <img class="img-parallax-home" src="/img/oblyk-home-chapeau-napoleon.jpg">
            <div class="div-entete-oblyk">
                <h1>Oblyk</h1>
                <p>Site communautaire dédié à l'escalade</p>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{--js particulier à la page--}}
    <script>

        $(document).ready(function(){
            $('.parallax').parallax();
        });

    </script>
    {{--<script type="text/javascript" src="{{url('/')}}/js/home.js"></script>--}}
@endsection
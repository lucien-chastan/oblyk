@extends('layouts.app')

@section('css')
    {{--css particulier à la page--}}
    {{--<link href="{{url('/')}}/css/home.css" rel="stylesheet">--}}
@endsection

@section('content')

    <div class="parallax-container">
        <div class="parallax"><img src="img/oblyk-home-baume-rousse.jpg"></div>
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
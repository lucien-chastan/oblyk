@extends('layouts.map')

@section('css')
    <link href="{{url('/')}}/css/map.css" rel="stylesheet">
@endsection

@section('content')

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div id="map"></div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        console.log('ok');
    </script>

@endsection

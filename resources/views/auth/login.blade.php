@extends('layouts.app')

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--formulaire de connexion--}}
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l8 offset-m2 offset-l2">

                {{--titre--}}
                <h1 class="loved-king-font text-center grey-text text-darken-3">Connexion</h1>

                <form class="row" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Adresse e-mail</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" name="password" required>
                        <label for="password">Password</label>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="finput-field col s12 m6 l6">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Se souvenir de moi</label>
                    </div>

                    <div class="finput-field col s12 m6 l6 text-right">
                        <a class="waves-effect waves-teal btn-flat blue-text" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <div class="finput-field col s12 text-center">
                        <button type="submit" class="btn waves-effect waves-light">
                            Connexion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app', [
    'meta_title'=> trans('meta/auth.title_register'),
    'meta_description'=>trans('meta/auth.description_register'),
    'meta_img'=>'/img/meta_home.jpg',
    ])

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--formulaire de connexion--}}
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l8 offset-m2 offset-l2">

                {{--titre--}}
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('auth.titleCreateAccount')</h1>

                <form class="row" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="input-field col s12{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                            <label for="name">@lang('auth.labelUsername')</label>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                            <label for="email">@lang('auth.labelEmail')</label>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" name="password" required>
                            <label for="password">@lang('auth.labelPassword')</label>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-field col s12">
                            <input id="password-confirm" type="password" name="password_confirmation" required>
                            <label for="password-confirm">@lang('auth.labelConfirmPassword')</label>
                        </div>

                        <div class="input-field col s12">
                            <input type="checkbox" name="newsletter" id="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                            <label for="newsletter">@lang('auth.labelNewsletter')</label>
                        </div>
                    </div>

                    <div class="col s12 text-center">
                        <button type="submit" class="btn waves-effect waves-light">
                            @lang('auth.btnCreateMyAccount')
                        </button>
                        <p class="text-center"><a href="{{ route('login') }}">@lang('auth.btnIHaveAAccount')</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

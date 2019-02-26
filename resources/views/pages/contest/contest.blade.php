@extends('layouts.app', [
    'meta_title'=> $contest->name(),
    'meta_description'=> $contest->description,
    'meta_img'=>'https://oblyk.org' . $contest->cover(),
    ])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/contest.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.contest-parallax')

    <div class="container">
        <div class="row">
            <div class="col s12 m9 l10">

                {{-- Global information --}}
                <div id="introduction" class="section scrollspy">
                    <h2 class="loved-king-font">Information sur le contest</h2>
                    <div class="row">
                        <div class="col s8">
                            @markdown($contest->description)

                            @if($contest->participantsAreLimited() && !$contest->isOutOfDate())
                                <p>
                                    <strong>Attention le nombre d'inscription est limitée !</strong><br>
                                    <span class="grey-text">il reste {{ $contest->remainingPlaces() }} places</span>
                                </p>
                            @endif

                            @if($contest->hasPresentationVideo())
                                {!! $contest->presentationVideo()->htmlIframe() !!}
                            @endif

                        </div>

                        <div class="col s4">
                            <p>
                                <strong>Quand ?</strong><br>
                                {{ $contest->period() }}<br>
                                @if($contest->isOutOfDate())
                                    <strong class="red-text">Le contest est fini.</strong>
                                    @if($contest->inAdditionalTime())
                                        <br>
                                        <span class="blue-text">
                                            il vous reste {{ $contest->endsWithAdditionalTimeInHowLong() }} pour noter vos lignes
                                        </span>
                                    @endif
                                @elseif($contest->comingSoon())
                                    <strong class="green-text">Commence dans {{ $contest->startsInHowLong() }}.</strong>
                                @elseif($contest->isNow())
                                    <strong class="blue-text">Contest en cours !</strong><br>
                                    <span class="grey-text">
                                        Il reste {{ $contest->endsInHowLong() }}
                                        @if($contest->haveAdditionalTime())
                                            <br>Vous aurez <strong>{{ $contest->minutes_after_end }} minutes</strong> après la fin du contest pour noter vos lignes.
                                        @endif
                                    </span>
                                @endif
                            </p>
                            <p>
                                <strong>Où ?</strong><br>
                                {{ $gym->label }}<br>
                                {{ $gym->address }}<br>
                                {{ $gym->postal_code }} {{ $gym->city }}<br>
                            </p>

                            @if(!$contest->isOutOfDate())
                                <div class="text-center">
                                    @if(Auth::check())
                                        @if($authUserIsRegistered)
                                            <button {!! $Helpers::modal(route('deleteModal'), ["route" => "/contestUsers/".$contestAuthUser->id, "callback" => 'refresh']) !!} class="btn-flat red-text btnModal">Me désinscrire</button>
                                        @else
                                            @if(!$contest->isFull())
                                                <button {!! $Helpers::modal(route('contestUserModal', ['contest_id'=>$contest->id, 'user_id'=>Auth::user()->id]), ["contest_id"=>$contest->id, 'user_id'=>Auth::user()->id, "title"=> $contest->subscribersNeedToBeValidated() ? "Me pré-inscrire au contest" : "M\'inscrire au contest", "method"=>"POST", "callback" => "refresh"]) !!} class="btn btn-primary btnModal">{{ $contest->subscribersNeedToBeValidated() ? "Me pré-inscrire" : "M\'inscrire" }}</button>
                                            @else
                                                <p class="red-text">Désolé, il n'y a plus de place disponible</p>
                                            @endif
                                        @endif
                                    @else
                                        <p class="grey-text">Il te faut un compte sur Oblyk pour participer au contest</p>
                                        <a href="{{ route('register') }}" class="btn btn-primary">Créer un compte</a><br>
                                        <a href="{{ route('login') }}">Connexion</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- lines --}}
                <div id="lines" class="section scrollspy">
                    <h2 class="loved-king-font">Les lignes à faire</h2>

                    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
                        <button {!! $Helpers::modal(route('contestRouteModal', ["contest_id"=>$contest->id]), ["gym_id"=>$gym->id, "contest_id"=>$contest->id, "title"=>'Ajouter des lignes au contest', "method"=>"POST", 'callback'=>'refresh']) !!} class="btn btn-flat btn btnModal">
                            Séléctionner les lignes
                            <i class="material-icons left">add</i>
                        </button>
                    @endif

                </div>

                {{-- Participants --}}
                <div id="participants" class="section scrollspy">
                    <p>Content </p>
                </div>

                {{-- Place and Contact --}}
                <div id="place_and_contact" class="section scrollspy">
                    <p>Content </p>
                </div>
            </div>
            <div class="col hide-on-small-only m3 l2" style="position: sticky; top: 60px;">
                <ul class="section table-of-contents">
                    <li><a href="#introduction">Information</a></li>
                    <li><a href="#lines">Lignes</a></li>
                    <li><a href="#participants">Classement</a></li>
                    <li><a href="#place_and_contact">Lieux &amp; Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/contest.js"></script>
    <script>
        $(document).ready(function(){
            $('.scrollspy').scrollSpy({scrollOffset: 200});
        });
    </script>
@endsection
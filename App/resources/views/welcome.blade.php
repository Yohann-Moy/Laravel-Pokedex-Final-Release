@extends('layouts.html_head')
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico" />
@extends('layouts.header')

@if (Route::has('login'))
    @auth
        @php
            $userIDVar = Auth::user()->id;

            $nbPokemonsVar =

            DB::table('pokemon_user')
            ->select('*')
            ->where('user_id','=', $userIDVar)
            ->count();

            $nbNotifs =
            DB::table('pokemon_user')
            ->select('*')
            ->where('user_id','=', $userIDVar)
            ->where('notification','=', 1)
            ->count();

        @endphp
    @endauth
@endif

@section('content')

<div class='home_page_centered_thing'>
    <div class='home_page_centered_container'>
    @if (Auth::check())
        @auth
            @if(Auth::user()->is_admin==1) <!-- Si l'utilisateur est connecté en tant qu'administrateur -->
                <h1>Bonjour administrateur {{Auth::user()->name}} !</h1>
                <h2>Que souhaitez vous faire aujourd'hui ?</h2>
                <div class='what_u_wanna_do_m8'>
                    <a href="{{ route('pokedex') }}">
                        <div class='homepage_nav_button_new'>
                            <img src='../img/pokedex_thumbnail.jpg'>
                            <div class='only_the_button'>
                                Gérer le pokédex
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin_users') }}">
                        <div class='homepage_nav_button_new'>
                            <img src='../img/gest_users.jpg'>
                            <div class='only_the_button'>
                                Gérer les utilisateurs
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            @elseif(Auth::user()->id) <!-- Si l'utilisateur est connecté en tant qu'utilisateur normal -->
                <h1>Bonjour dresseur {{Auth::user()->name}}!</h1>
                <h2>Que souhaitez vous faire aujourd'hui ?</h2>
                <div class='what_u_wanna_do_m8'>
                    <a href="{{ route('pokedex') }}">
                        <div class='homepage_nav_button_new'>
                            <img src='../img/pokedex_thumbnail.jpg'>
                            <div class='only_the_button'>
                                Consulter le pokédex / Capturer
                            </div>
                        </div>
                    </a>
                    @if($nbPokemonsVar>0)

                        <form method="post" action="{{route('my_pokemons')}}"  id="formulaire_de_contact" class='homepage_nav_button_form'> <!-- Redirige sur la page create de la todolist après submit -->
                            @csrf
                            <button type="submit" id="bouton_envoyer" class='homepage_nav_button_new_button homepage_nav_button_new'>
                                <img src='../img/my_pokemons_thumbnail.jpg'>
                                <div class='only_the_button'>
                                    <p>Gérer mes captures / Échanger</p>
                                </div>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                            </button>
                            @if($nbNotifs > 0)
                                <div class='notification_m808'>
                                    <p title='Vous avez {{$nbNotifs}} notification(s)'>{{$nbNotifs}}</p>
                                </div>
                            @endif
                        </form>
                    </div>
                    @endif
                </div>
            @endif
        @endauth

    @else <!-- Si l'utilisateur n'est pas connecté -->
        <h1>Bienvenue sur mon projet de Pokédex</h1>
        <h2>En tant que visiteur, tu ne peux que consulter le Pokédex.</h2>
        <div class='what_u_wanna_do_m8'>
            <a href="{{ route('pokedex') }}">
                <div class='homepage_nav_button_new'>
                    <img src='../img/pokedex_thumbnail.jpg'>
                    <div class='only_the_button'>
                        Consulter le pokédex
                    </div>
                </div>
            </a>
        </div>
        <p style='margin-top:2rem;'>Pour disposer de plus de contenu, <a href='{{ route('login') }}'>connectes-toi</a> ou <a href="{{ route('register') }}">crées toi un compte</a>!</p>
    @endif
    </div>
</div>

    <div class='main-content' id='side-bar'>
        <div class='side-bar-content'>

            <h2>Cadre :</h2>
            <ul>
                <li>Découverte Laravel 6</li>
                <li>Formateur : Paul Delcloy</li>
            </ul>

            <h2>Fonctionnalités</h2>
            <ul class='fonctionnalities'>

                <li>Authentification (inscription / connexion)</li><br>

                <li style='text-decoration:underline; margin-bottom:0.5rem;'>Gestion d’un rôle administrateur :</li>
                <li>- C.R.U.D de Pokémons</li>
                <li>- C.R.U.D des utilisateurs</li>
                <li>- Gestion des pokémons de chaque user</li><br>

                <li style='text-decoration:underline; margin-bottom:0.5rem;'>Gestion d'un rôle utilisateur (dresseur) :</li>
                <li>- Posséder un ou plusieurs pokémons (one to many)</li>
                <li>- Posséder les mêmes pokémons qu'un autre user (many to many)</li>
                <li>- Intéragir avec les pokémons d'autres users (échange)</li><br>

                <li>Dynamisation avec AJAX.</li><br>

                <li style='text-decoration:underline; margin-bottom:0.5rem;'>Ajouts personnels :</li>
                <li>- Favicon !!!!!</li>
                <li>- CSS 90% from scratch</li>
                <li>-  Interface responsive</li>
                <li>- Donner un surnom au pokémon</li>
                <li>- Système de notifications (pour les échanges)</li>
                <li>- Plus encore si jamais y'a le time... ;)</li>
            </ul>
        </div>
    </div><!--
 --><div class='main-content' id='main-stuff'>
    </div>

@endsection
@extends('layouts.html_footer')

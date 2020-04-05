<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico" />
<header id="welcome-head">
    <a href="{{ url('/') }}"><div id='pokedex_logo' class='top_bar_element'></div></a><!--
 --><div id='top-right' class='top_bar_element links'>

        @if (Route::has('login'))
            @auth
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                >Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            @else
                <a class='burger_menu'><img src='../img/burger.png'></a>
                <a class='burger_menu_disapear' href="{{ route('login') }}">Connexion</a>

                @if (Route::has('register'))
                    <a class='burger_menu_disapear' href="{{ route('register') }}">Inscription</a>
                @endif
            @endauth
        @endif
    </div>

    <div class='burger_menu_content'>
        <a href="{{ route('login') }}">Connexion</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Inscription</a>
        @endif
    </div>

</header>

<main>
    @yield('content')
</main>

@extends('layouts.html_head')
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico" />
@extends('layouts.header')

<main>
    @section('content')
        @foreach ($getaPokemon as $getapokemonVar)
            <p>{{Auth::user()->name}}, un {{ $getapokemonVar->nom }} sauvage est apparu!</p>
                <div class='list_content' id='list_content_{{$getapokemonVar->id}}'>
                    <img src={{ $getapokemonVar->image }}>
                    <p>{{ $getapokemonVar->nom }}</p>  <!-- On affiche le nom du pokemon -->
                    <p>{{ $getapokemonVar->numero }}</p>
                    <p>{{ $getapokemonVar->type1 }}</p>
                    <p>{{ $getapokemonVar->type2 }}</p>
                    @php
                    $userIDVar=Auth::user()->id;
                @endphp
                <form method="post" action="{{route('catch_this_pokemon', ['id'=>$getapokemonVar->id, 'user_id'=>$userIDVar])}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                    @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                <button type="submit" id="bouton_envoyer">Capturer ce pokemon</button>
                </form>
                </div>
        @endforeach

    @endsection
</main>
@extends('layouts.html_footer')

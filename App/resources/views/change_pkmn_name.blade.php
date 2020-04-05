@extends('layouts.html_head')
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico" />
@extends('layouts.header')

<meta name="csrf-token" content="{!! csrf_token() !!}">

@section('content')
    <h1>Changer le surnom d'un pokemon</h1>

    @foreach ($personnalPokedex ?? '' as $personnalPokedexVar)
        <div class='list_content' id='list_content_{{$personnalPokedexVar->id}}'>
            <img src={{ $personnalPokedexVar->image }}>
            <p>Surnom actuel : {{ $personnalPokedexVar->pkmn_surnom }}</p>

            <form method="post" action="{{route('change_pokemon_name_action')}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                @csrf
                <input type="hidden" name="pkmn_id" value="{{ $personnalPokedexVar->id}}"/>
                <input type="hidden" name="user_id" value="{{ $personnalPokedexVar->user_id}}"/>
                <input type="hidden" name="old_nickname" value="{{ $personnalPokedexVar->pkmn_surnom}}"/>

                <label>Nouveau surnom :</label>
                <input type="text" name = "pkmn_new_surnom" placeholder="{{$personnalPokedexVar->pkmn_surnom}}"/>
                <button type="submit" id="bouton_envoyer">Valider</button>
            </form>

            <p>Pour supprimer le surnom du pokemon saisissez "/" dans la zonne de texte</p>

            {{-- <a href="{{route('change_pokemon_name', ['id'=>$personnalPokedexVar->id])}}">Relacher</a> --}}
            {{-- <a href="{{route('release_pokemon', ['id'=>$personnalPokedexVar->id])}}">Relacher</a> --}}
            {{-- <a href="{{route('change_pokemon_name', ['user_id'=>{{Auth::user()->id}}, 'id'=>$personnalPokedexVar->id])}}">Changer surnom</a> --}}
        </div>
    @endforeach
@endsection

@extends('layouts.html_footer')

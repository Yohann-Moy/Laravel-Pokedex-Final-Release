@extends('layouts.html_head')
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico" />
@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><h1>Modifier {{($editPokemon->nom)}}</h1></div>
                <div class="card-body">
                    <form method="post" action="{{route('update_pkmn', ['id'=>$editPokemon->id])}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                        @csrf
                        <input type="text" name="nom" placeholder="{{($editPokemon->nom)}}" id="form_nom" class="required">
                        <input type="number" min="0" name="numero" placeholder="{{($editPokemon->numero)}}" id="form_tache" class="required">

                        <select name="type1" id="pokemontype1" class="required">
                            <option value="{{($editPokemon->type1)}}">-- Choissisez une option --</option>
                            <option value="Acier">Acier</option>
                            <option value="Combat">Combat</option>
                            <option value="Dragon">Dragon</option>
                            <option value="Eau">Eau</option>
                            <option value="Electrik">Electrik</option>
                            <option value="Fée">Fée</option>
                            <option value="Feu">Feu</option>
                            <option value="Glace">Glace</option>
                            <option value="Insecte">Insecte</option>
                            <option value="Normal">Normal</option>
                            <option value="Plante">Plante</option>
                            <option value="Poison">Poison</option>
                            <option value="Psy">Psy</option>
                            <option value="Roche">Roche</option>
                            <option value="Sol">Sol</option>
                            <option value="Spectre">Spectre</option>
                            <option value="Ténèbre">Ténèbre</option>
                            <option value="Vol">Vol</option>
                        </select>

                        <select name="type2" id="pokemontype2" class="required">
                            <option value="{{($editPokemon->type2)}}">/</option>
                            <option value="Acier">Acier</option>
                            <option value="Combat">Combat</option>
                            <option value="Dragon">Dragon</option>
                            <option value="Eau">Eau</option>
                            <option value="Electrik">Electrik</option>
                            <option value="Fée">Fée</option>
                            <option value="Feu">Feu</option>
                            <option value="Glace">Glace</option>
                            <option value="Insecte">Insecte</option>
                            <option value="Normal">Normal</option>
                            <option value="Plante">Plante</option>
                            <option value="Poison">Poison</option>
                            <option value="Psy">Psy</option>
                            <option value="Roche">Roche</option>
                            <option value="Sol">Sol</option>
                            <option value="Spectre">Spectre</option>
                            <option value="Ténèbre">Ténèbre</option>
                            <option value="Vol">Vol</option>
                        </select>

                        <input type="text" name="image" placeholder="{{($editPokemon->image)}}" id="form_tache" class="required">
                        <img src="{{($editPokemon->image)}}">
                        <button type="submit" id="bouton_envoyer">Modifier ce pokemon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href='{{ url()->previous() }}' class='return_button_thing' >← Retour</a>
</div>
@endsection

@extends('layouts.html_footer')

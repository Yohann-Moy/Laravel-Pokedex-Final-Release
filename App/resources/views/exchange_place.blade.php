@extends('layouts.html_head')
@extends('layouts.header')

<main>

@php
    $compteur_de_pokemons_a_echanger = 0;
@endphp

    @section('content')
    <h1>Bienvenue sur la place aux échanges {{Auth::user()->name}} !</h1>

    <h2 class='place_is_open'>Quel pokémon souhaitez vous échanger contre votre {{$pokemonEspece[0]->nom}} ( {{$pokemonSurnom[0]->pkmn_surnom }} )</h2>


    <div class='list_items'>
        @foreach ($toExchangePokemonList ?? '' as $toExchangePokemon)
                @if($toExchangePokemon->user_id != Auth::user()->id)
                    @php
                        $compteur_de_pokemons_a_echanger++;
                    @endphp

                    <div class='list_content' id='list_content_{{$toExchangePokemon->id}}'>
                        <h2>{{ $toExchangePokemon->nom }}</h2>  <!-- On affiche le nom du pokemon -->
                        <h3 class='surnom_{{$toExchangePokemon->id}}'>( {{ $toExchangePokemon->pkmn_surnom }} )</h3>

                        @if(($toExchangePokemon->numero) < 10)
                            <p>N° 00{{ $toExchangePokemon->numero }}</p>
                        @elseif(($toExchangePokemon->numero)>=10 && ($toExchangePokemon->numero)<100)
                            <p>N° 0{{ $toExchangePokemon->numero }}</p>
                        @else
                            <p>N° {{ $toExchangePokemon->numero }}</p>
                        @endif

                        <div class='pkmn_img_row'>
                            <img src={{ $toExchangePokemon->image }}>
                        </div>
            <!--             @if(($toExchangePokemon->pkmn_surnom) != '/')
                            <p>Surnom : {{ $toExchangePokemon->pkmn_surnom }}</p>
                            @endif -->

                        <div class='pkmn_type_row_context'>
                            <div class='pkmn_type {{ $toExchangePokemon->type1 }}'>
                                <p>{{ $toExchangePokemon->type1 }}</p>
                            </div>
                            <div class='pkmn_type {{ $toExchangePokemon->type2 }}'>
                                <p>{{ $toExchangePokemon->type2 }}</p>
                            </div>
                        </div>
                        <div class='actual_trainer'>
                            @foreach($trainersList as $trainer)
                                @if(($toExchangePokemon->user_id) == $trainer->id)
                                    <p>-- Déposé par : {{$trainer->name}} --</p>
                                @endif
                            @endforeach

                        </div>

                        <button type="button" data-toggle="modal" class="gotchaaaa_edit_pkmn" data-target="#JeVeuxLuiModal{{ $toExchangePokemon->id }}">Je le veux!</button>
                            <!-- DONNER POKEMON SURNOM Modal -->
                                <!-- The Modal -->
                                <div class="modal fade" id="JeVeuxLuiModal{{ $toExchangePokemon->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Réaliser l'échange suivant ?</h4>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class='inline_pokemon_exchange'>
                                                    <img src="{{ $pokemonEspece[0]->image }}">
                                                </div>
                                                <div class='inline_pokemon_exchange' id='exchange_arrows'>
                                                </div>
                                                <div class='inline_pokemon_exchange'>
                                                    <img src="{{ $toExchangePokemon->image }}">
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form method="post" action="{{route('realiser_l_echange')}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                    @csrf
                                                    <input type='hidden' name='pokemon_echange_row_id' value='{{$pokemonCatchID[0]->id}}'>
                                                    <input type='hidden' name='pokemon_propose_user_id' value='{{$toExchangePokemon->user_id}}'>
                                                    <input type='hidden' name='pokemon_propose_row_id' value='{{$toExchangePokemon->id}}'>

                                                    <button type="submit" id="bouton_envoyer"  class='are_you_sure'>Oui</button>
                                                </form>

                                                <button type="submit" id="bouton_envoyer" data-dismiss="modal" class='are_you_sure'>Non</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                @endif
        @endforeach
    </div>

    @if($compteur_de_pokemons_a_echanger<=0)
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>
           $(document).ready(function(){
            $('.list_items').remove();
            $('.place_is_open').remove();
           });
        </script>
        <div class='error_image'>
            <img src='../img/error.png'>
        </div>
        <h2>La place aux échanges est malheureusement fermée.</h2>
        <h3>Aucun autre dresseur n'a souhaité procéder à un échange miracle.</h3>

    @endif
    <form method="post" action="{{route('my_pokemons')}}" id="formulaire_de_contact">
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <button type='submit' class='return_button_thing' id='bouton_envoyer' style='border:none;'>← Retour</button>
        <button type='submit' class='return_button_thing_responsive' id='bouton_envoyer' style='border:none;'>←</button>
    </form>
    @endsection

</main>
@extends('layouts.html_footer')

@extends('layouts.html_head')
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico" />
@extends('layouts.header')

<meta name="csrf-token" content="{!! csrf_token() !!}">

@section('content')
    <div class="card-body">
        @if (Auth::check())
            @auth
                @if(Auth::user()->is_admin==1) <!-- Si l'utilisateur est connecté en tant qu'administrateur -->
                    <h1>Captures de {{$diplayUserName[0]->name}}</h1>
                    <input type ='hidden' id='whoIsConnected' value='1'> <!-- Permet de savoir en JS quel message afficher pour le P avec ID status-->
                    <p id='status'></p>
                    @if($personnalPokedex->isEmpty())
                        <p id='status'>Ce dresseur n'a pas encore capturé de pokémons ou bien ils ont tous été relâchés.</p>
                    @else
                        <div class='list_items'>
                            @foreach ($personnalPokedex ?? '' as $personnalPokedexVar)
                                <div class='list_content' id='list_content_{{$personnalPokedexVar->id}}'>
                                    <h2>{{ $personnalPokedexVar->nom }}</h2>  <!-- On affiche le nom du pokemon -->
                                    <h3>( {{ $personnalPokedexVar->pkmn_surnom }} )</h3>

                                    @if(($personnalPokedexVar->numero) < 10)
                                        <p>N° 00{{ $personnalPokedexVar->numero }}</p>
                                    @elseif(($personnalPokedexVar->numero)>=10 && ($personnalPokedexVar->numero)<100)
                                        <p>N° 0{{ $personnalPokedexVar->numero }}</p>
                                    @else
                                        <p>N° {{ $personnalPokedexVar->numero }}</p>
                                    @endif
                                    <div class='pkmn_img_row'>
                                        <img src={{ $personnalPokedexVar->image }}>
                                    </div>
                        <!--             @if(($personnalPokedexVar->pkmn_surnom) != '/')
                                        <p>Surnom : {{ $personnalPokedexVar->pkmn_surnom }}</p>
                                    @endif -->

                                    <div class='pkmn_type_row_context'>
                                        <div class='pkmn_type {{ $personnalPokedexVar->type1 }}'>
                                            <p>{{ $personnalPokedexVar->type1 }}</p>
                                        </div>
                                        <div class='pkmn_type {{ $personnalPokedexVar->type2 }}'>
                                            <p>{{ $personnalPokedexVar->type2 }}</p>
                                        </div>
                                    </div>

                                    <button type="button" data-toggle="modal" class='release_this_pokemon' data-target="#RelacherLuiModal{{ $personnalPokedexVar->id }}">Relâcher</button>
                                    <!-- DONNER POKEMON SURNOM Modal -->
                                        <!-- The Modal -->
                                        <div class="modal fade" id="RelacherLuiModal{{ $personnalPokedexVar->id }}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Êtes vous certain de vouloir relâcher {{ $personnalPokedexVar->nom }} ?</h4>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="homepage_nav_button">
                                                            <a data-dismiss='modal' href='{{route('release_pokemon_ajax', ['id'=>$personnalPokedexVar->id])}}' class='release_pokemon' data-id="{{$personnalPokedexVar->id}}" >Oui</a>
                                                        </div>
                                                        <div class="homepage_nav_button">
                                                            <button type="submit" id="bouton_envoyer" data-dismiss="modal" class='are_you_sure'>Non</button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
{{--                             Titix        <form method="post" action="{{route('realiser_l_echange')}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                        @csrf
                                        <input type='hidden' name='pokemon_echange_row_id' value='{{$pokemonCatchID[0]->id}}'>
                                        <input type='hidden' name='pokemon_propose_user_id' value='{{$toExchangePokemon->user_id}}'>
                                        <input type='hidden' name='pokemon_propose_row_id' value='{{$toExchangePokemon->id}}'>

                                        <button type="submit" id="bouton_envoyer"  class='are_you_sure'>Oui</button>
                                    </form>

                                    <button type="submit" id="bouton_envoyer" data-dismiss="modal" class='are_you_sure'>Non</button> --}}


                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="container">

                        <!-- Button to Open the Modal -->
                        <div class='action_div_special'>
                            <div class='admin_user_gest_nav_button_add'>
                                <button type="button" data-toggle="modal" class='add_un_pokemon_au_pokedex' data-target="#userAddPokemonModal">Affecter un pokemon</button>
                                <button type="button" data-toggle="modal" class='add_un_pokemon_au_pokedex_responsive' data-target="#userAddPokemonModal">+</button>
                            </div>
                        </div>
                        <!-- The Modal -->
                        <div class="modal fade" id="userAddPokemonModal">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Affecter un pokémon à {{$diplayUserName[0]->name}}</h4>
                              </div>

                              <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="post" action=" {{route('add_pokemon_to_a_user')}} " id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                        @csrf
                                        <div class='form_content_input_last'>

                                            <label class='inline_special'>Choisissez un pokémon : </label>
                                            <select id="select_pokemon" name="select_pokemon" class='inline'>
                                                @foreach ($displayPokemonName ?? '' as $pokemonList)
                                                    <option name='pokemon_id' value="{{$pokemonList->id}}">{{$pokemonList->nom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <input type="hidden" name="user_id" value="{{$diplayUserName[0]->id}}"/>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" id="bouton_envoyer_{{$pokemonList->id}}" class='add_pokemon_to_user'>Affecter</button>
                                    </form>
                                </div>

                            </div>
                          </div>
                        </div>

                      </div>


                @elseif(Auth::user()->is_admin==0) <!-- Si l'utilisateur est connecté en tant qu'utilisateur normal -->
                    <h1>Mes captures</h1>
                    <input type ='hidden' id='whoIsConnected' value='0'> <!-- Permet de savoir en JS quel message afficher pour le P avec ID status-->
                    <p id='status'></p>
                    @if($personnalPokedex->isEmpty())
                        <p>Vous n'avez pas encore capturé de pokémons ou bien vous les avez tous relâché.</p>
                    @else
                        <div class='list_items'>
                            @foreach ($personnalPokedex ?? '' as $personnalPokedexVar)
                                <div class='list_content @if($personnalPokedexVar->notification==1) show  @endif' id='list_content_{{$personnalPokedexVar->id}}'>
                                    @if($personnalPokedexVar->origin_trainer == Auth::user()->name)
                                    @else
                                        <div class="pokemon_echange" title="Dresseur d'origine : {{$personnalPokedexVar->origin_trainer}}"></div>
                                    @endif
                                    <h2>{{ $personnalPokedexVar->nom }}</h2>  <!-- On affiche le nom du pokemon -->
                                    <h3 class='surnom_{{$personnalPokedexVar->id}}'>( {{ $personnalPokedexVar->pkmn_surnom }} )</h3>

                                    @if(($personnalPokedexVar->numero) < 10)
                                        <p>N° 00{{ $personnalPokedexVar->numero }}</p>
                                    @elseif(($personnalPokedexVar->numero)>=10 && ($personnalPokedexVar->numero)<100)
                                        <p>N° 0{{ $personnalPokedexVar->numero }}</p>
                                    @else
                                        <p>N° {{ $personnalPokedexVar->numero }}</p>
                                    @endif
                                    <div class='pkmn_img_row'>
                                        <img src={{ $personnalPokedexVar->image }}>
                                    </div>
                        <!--             @if(($personnalPokedexVar->pkmn_surnom) != '/')
                                        <p>Surnom : {{ $personnalPokedexVar->pkmn_surnom }}</p>
                                    @endif -->

                                    <div class='pkmn_type_row_context'>
                                        <div class='pkmn_type {{ $personnalPokedexVar->type1 }}'>
                                            <p>{{ $personnalPokedexVar->type1 }}</p>
                                        </div>
                                        <div class='pkmn_type {{ $personnalPokedexVar->type2 }}'>
                                            <p>{{ $personnalPokedexVar->type2 }}</p>
                                        </div>
                                    </div>

                                    <button type="button" data-toggle="modal" class='release_this_pokemon' data-target="#RelacherLuiModal{{ $personnalPokedexVar->id }}">Relâcher</button>
                                    <!-- DONNER POKEMON SURNOM Modal -->
                                        <!-- The Modal -->
                                        <div class="modal fade" id="RelacherLuiModal{{ $personnalPokedexVar->id }}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Êtes vous certain de vouloir relâcher {{ $personnalPokedexVar->nom }} ?</h4>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="homepage_nav_button">
                                                            <a data-dismiss='modal' href='{{route('release_pokemon_ajax', ['id'=>$personnalPokedexVar->id])}}' class='release_pokemon' data-id="{{$personnalPokedexVar->id}}" >Oui</a>
                                                        </div>
                                                        <div class="homepage_nav_button">
                                                            <button type="submit" id="bouton_envoyer" data-dismiss="modal" class='are_you_sure'>Non</button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>


                                        @if(($personnalPokedexVar->pkmn_surnom) != '/')
                                            <button type="button" data-toggle="modal" class='gotchaaaa_surnom' data-target="#EditSurnomModal{{ $personnalPokedexVar->id }}">Changer de surnom</button>
                                            <!-- EDITER POKEMON SURNOM Modal -->

                                            <!-- The Modal -->
                                            <div class="modal fade" id="EditSurnomModal{{ $personnalPokedexVar->id }}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                    <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Changer le surnom de {{$personnalPokedexVar->nom}}</h4>
                                                        </div>

                                                    <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form method="post" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                            @csrf
                                                            <input type="hidden" name="pkmn_id" value="{{ $personnalPokedexVar->id}}"/>
                                                            <input type="hidden" name="old_nickname" value="{{ $personnalPokedexVar->pkmn_surnom}}" id="pkmn_old_nickname_{{ $personnalPokedexVar->id}}"/>
                                                                <div class='form_content_input_last'>
                                                                    <label class='inline'>Surnom :</label>
                                                                    <input type="text" name="pkmn_new_surnom" value="{{$personnalPokedexVar->pkmn_surnom}}" id="form_nom_edit_{{$personnalPokedexVar->id}}" class='inline' required>
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="bouton_envoyer" data-dismiss="modal" class='change_pkmn_surnom_validate' data-id="{{$personnalPokedexVar->id}}">Modifier</button>
                                                                    </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- <button type="submit" id="bouton_envoyer" class='gotchaaaa'>Changer de surnom</button> --}}
                                        @else
                                            <button type="button" data-toggle="modal" class='gotchaaaa_surnom' data-target="#DonnerSurnomModal{{ $personnalPokedexVar->id }}">Donner un surnom</button>
                                            <!-- DONNER POKEMON SURNOM Modal -->

                                            <!-- The Modal -->
                                            <div class="modal fade" id="DonnerSurnomModal{{ $personnalPokedexVar->id }}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                    <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Donner un surnom à {{$personnalPokedexVar->nom}}</h4>
                                                        </div>

                                                    <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('change_pokemon_name_action')}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                            @csrf
                                                            <input type="hidden" name="pkmn_id" value="{{ $personnalPokedexVar->id}}"/>
                                                            <input type="hidden" name="old_nickname" value="{{ $personnalPokedexVar->pkmn_surnom}}" id="pkmn_old_nickname_{{ $personnalPokedexVar->id}}"/>
                                                                <div class='form_content_input_last'>
                                                                    <label class='inline'>Surnom :</label>
                                                                    <input type="text" name="pkmn_new_surnom"  value="{{$personnalPokedexVar->pkmn_surnom}}" id="form_nom_edit_{{$personnalPokedexVar->id}}" class='inline' required>
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="bouton_envoyer" data-dismiss="modal" class='change_pkmn_surnom_validate' data-id="{{$personnalPokedexVar->id}}" data-nom="Titou">Valider</button>
                                                                    </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        @endif

                                    {{-- </form>  A RETIRER EN CAS DE PROBLEME --}}

                                    @if($personnalPokedexVar->echange == 0)
                                        <!-- Echanger le pokémon -->
                                        <button type="button" data-toggle="modal" id='gotchaaaa_exchange_{{ $personnalPokedexVar->id }}' class='gotchaaaa_exchange' data-target="#ExchangeModal{{ $personnalPokedexVar->id }}">Échanger</button>
                                    @else <!-- -->
                                    <!-- Récupérer le pokémon -->
                                        <button type="button" data-toggle="modal" id='gotchaaaa_exchange_madeup_{{ $personnalPokedexVar->id }}' class='gotchaaaa_exchange' data-target="#ExchangeGetBackModal{{ $personnalPokedexVar->id }}">Récupérer</button>

                                    @endif

                                    <!-- ECHANGER un pokemon MODAL -->
                                    <div class="container">

                                        <!-- The Modal -->
                                        <div class="modal fade" id="ExchangeModal{{ $personnalPokedexVar->id }}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Échanger {{ $personnalPokedexVar->nom }} ( {{$personnalPokedexVar->pkmn_surnom}} )</h4>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                            <div class="homepage_nav_button">
                                                                <form method="post" action=" {{-- {{route('add_pokemon_to_a_user')}} --}} " id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                                    @csrf
                                                                    <button type="submit" id="bouton_envoyer_{{$personnalPokedexVar->id}}" data-id='{{$personnalPokedexVar->id}}' data-dismiss="modal" class='envoyer_mon_pokemon'>Déposer pour échange</button>
                                                                </form>
                                                            </div>



                                                            <div class="homepage_nav_button">
                                                                <form method="post" action=" {{route('place_d_echange')}} " id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                                    <input type=hidden name ='row_id' value='{{$personnalPokedexVar->id}}'>
                                                                    <input type=hidden name ='pokemon_id' value='{{$personnalPokedexVar->pokemon_id}}'>
                                                                    @csrf
                                                                    <button type="submit" id="bouton_envoyer_{{$personnalPokedexVar->id}}" class='place_d_echange'>Place d'echange</button>
                                                                </form>
                                                            </div>

                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <p>* Dépose votre pokémon sur une place d'échange.<br>
                                                            Le pokémon reçu en échange est une surprise.<br>
                                                            Sera t-elle bonne ?
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RECUPERER UN POKEMON MODAL -->
                                    <div class="container">

                                        <!-- The Modal -->
                                        <div class="modal fade" id="ExchangeGetBackModal{{ $personnalPokedexVar->id }}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Récupérer {{ $personnalPokedexVar->nom }} ( {{$personnalPokedexVar->pkmn_surnom}} ) ?</h4>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="homepage_nav_button">
                                                            <form method="post" action=" {{route('recuperer_un_pokemon')}} " id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                                @csrf
                                                                <button type="submit" data-id='{{$personnalPokedexVar->id}}' data-dismiss="modal" id="bouton_envoyer" class='recuperer_mon_pokemon'>Oui</button>
                                                            </form>
                                                        </div>

                                                        <div class="homepage_nav_button">
                                                            <button type="submit" id="dismiss-modal" data-dismiss="modal" class='place_d_echange'>Non</button>
                                                        </div>
                                                    </div>



                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <p>* Récupérer votre pokémon siginifie le retirer de la place d'échange et ainsi restreindre sa visibilité à vous seul. </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            @endauth
        @endif

        @if (Auth::check())
            @auth
                @if(Auth::user()->is_admin==1)
                    <a href='{{route('admin_users')}}' class='return_button_thing'>← Retour</a>
                    <a href='{{route('admin_users')}}' class='return_button_thing_responsive'>←</a>
                @elseif(Auth::user()->is_admin==0)
                    <a href='../' class='return_button_thing'>← Retour</a>
                    <a href='../' class='return_button_thing_responsive'>←</a>
                @endif
            @endauth
        @endif
    </div>
@endsection

@php
    //sleep(1);

    $notificationReset =

    DB::table('pokemon_user')
    ->where('user_id','=', Auth::user()->id)
    ->update(['notification' => 0]);

@endphp

@extends('layouts.html_footer')

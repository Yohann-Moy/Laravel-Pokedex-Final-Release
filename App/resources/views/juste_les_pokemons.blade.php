
@foreach ($pokemon ?? '' as $pokemonVar)

                    <div class='list_content' id='list_content_{{$pokemonVar->id}}'>
                    @if (Route::has('login'))
                        @auth
                            @if(Auth::user()->is_admin==1) <!-- Si l'utilisateur est connecté en tant qu'administrateur -->
                                <div class='pkmn_delete_ajax_action'>
                                    <a name="delete_pokemon_trigger" href="{{route('delete_pkmn', ['id'=>$pokemonVar->id])}}" class='del_pokemon' id="{{$pokemonVar->id}}">x</a>
                                </div>
                            @endif
                        @endauth
                    @endif
                    <h2>{{ $pokemonVar->nom }}</h2>  <!-- On affiche le nom du pokemon -->
                    @if (Route::has('login'))

                        @auth
                        <!-- {{ $userIDVar=Auth::user()->id }} -->
                            @if(Auth::user()->is_admin!=1) <!-- Si l'utilisateur n'est pas connecté en tant qu'administrateur -->
                                @foreach($pokemonUserTable as $pokemonUserThing)
                                    @if(($pokemonVar->id == $pokemonUserThing->pokemon_id) && ($pokemonUserThing->user_id == $userIDVar))
                                        @php
                                            $compteur_de_capture++;
                                        @endphp
                                    @endif
                                @endforeach

                                @if($compteur_de_capture > 0) {{-- Si le pokémon a déja été capturé au moins une fois --}}
                                    <div class='pokemon_capture'></div>
                                @endif

                                @php
                                    $compteur_de_capture = 0;
                                @endphp
                            @endif
                        @endauth
                    @endif

                    @if(($pokemonVar->numero) < 10)
                        <p>N° 00{{ $pokemonVar->numero }}</p>

                    @elseif(($pokemonVar->numero)>=10 && ($pokemonVar->numero)< 100)
                        <p>N° 0{{ $pokemonVar->numero }}</p>

                    @else
                        <p>N° {{ $pokemonVar->numero }}</p>
                    @endif

                    <div class='pkmn_img_row'>
                        <img src={{ $pokemonVar->image }}>
                    </div>

                    <div class='pkmn_type_row_context'>
                        <div class='pkmn_type {{ $pokemonVar->type1 }}'>
                            <p>{{ $pokemonVar->type1 }}</p>
                        </div>

                        <div class='pkmn_type {{ $pokemonVar->type2 }}'>
                            <p>{{ $pokemonVar->type2 }}</p>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        @auth
                            @if(Auth::user()->is_admin==1) <!-- Si l'utilisateur est connecté en tant qu'administrateur -->
                                <button class="gotchaaaa_edit_pkmn" type="button" data-toggle="modal" data-target="#EditPokemonModal{{ $pokemonVar->id }}">Éditer ✐</button>


                                    <!-- EDITER POKEMON Modal -->

                                    <!-- The Modal -->
                                    <div class="modal fade" id="EditPokemonModal{{ $pokemonVar->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Modifier {{$pokemonVar->nom}}</h4>
                                                </div>

                                            <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form method="post" action="{{route('update_pkmn', ['id'=>$pokemonVar->id])}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                    @csrf
                                                        <div class='form_content_input'>
                                                            <label class='inline'>Pokedex ID :</label>
                                                            @if(($pokemonVar->numero) < 10)
                                                                <input type="number" min="0" name="numero" value="00{{$pokemonVar->numero}}" id="form_numero_edit_{{$pokemonVar->id}}" class='inline' required>
                                                            @elseif(($pokemonVar->numero)>=10 && ($pokemonVar->numero)< 100)
                                                                <input type="number" min="0" name="numero" value="0{{$pokemonVar->numero}}" id="form_numero_edit_{{$pokemonVar->id}}" class='inline' required>
                                                            @else
                                                            <input type="number" min="0" name="numero" value="{{$pokemonVar->numero}}" id="form_numero_edit_{{$pokemonVar->id}}" class='inline' required>
                                                            @endif
                                                        </div>

                                                        <div class='form_content_input'>
                                                            <label class='inline'>Nom :</label>
                                                            <input type="text" name="nom" value="{{$pokemonVar->nom}}" id="form_nom_edit_{{$pokemonVar->id}}" class='inline' required>
                                                        </div>

                                                        <div class='form_content_input'>
                                                            <label class='inline'>Type 1 :</label>
                                                            <select name="type1" id="pokemontype1_edit_{{$pokemonVar->id}}" class='inline' required>
                                                                <option value="{{$pokemonVar->type1}}">{{$pokemonVar->type1}} (intial)</option>
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
                                                        </div>

                                                        <div class='form_content_input'>
                                                            <label class='inline'>Type 2 :</label>
                                                            <select name="type2" id="pokemontype2_edit_{{$pokemonVar->id}}" class='inline' required>
                                                                <!-- Initial value -->
                                                                <option value="{{$pokemonVar->type2}}">{{$pokemonVar->type2}} (initial)</option>
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
                                                        </div>

                                                        <div class='form_content_input_last'>
                                                            <label class='inline'>Sprite :</label>
                                                            <input type="text" name="image" value="{{$pokemonVar->image}}" id="form_image_edit_{{$pokemonVar->id}}" class='inline'>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="edit_pokemon_trigger" class='submit_edit_pokemon' id="bouton_envoyer_{{$pokemonVar->id}}" data-dismiss="modal" data-id="{{$pokemonVar->id}}">Modifier </button>
                                                            </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- <li><a href="{{route('update_pokemon', ['id'=>$pokemonVar->id])}}" class='gotchaaaa'>Éditer ✐</a></li> --}} <!-- Redirige sur la page modifier de la todolist en prenant en compte l'ID -->
                            @else

                            <form method="post" action="{{route('catch_this_pokemon', ['id'=>$pokemonVar->id, 'user_id'=>$userIDVar])}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                @csrf
                                <input type="hidden" name="user_id" id="gotchaaaa_value_{{$pokemonVar->id}}" value="{{Auth::user()->id}}"/>
                            <button type="submit" id="bouton_capturer" class='gotchaaaa' data-id="{{$pokemonVar->id}}">Capturer ce pokemon</button>
                            </form>

                            @endif
                        @endauth
                    @endif

                    </div>
                @endforeach

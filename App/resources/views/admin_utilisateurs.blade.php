@extends('layouts.html_head')
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico" />
@extends('layouts.header')

<meta name="csrf-token" content="{!! csrf_token() !!}">

@section('content')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> --}}


<main>

    @section('content')
    <div class="container">
            <h1>Administration des utilisateurs</h1>
                <div class='make_a_responsive_tab'>
                    <TABLE BORDER="1">
                        <TR>
                            <TH> id </TH>
                            <TH> Nom </TH>
                            <TH> Email </TH>
                            <TH> Mot de passe </TH>
                            <TH> Admin </TH>
                            <TH> Editer </TH>
                            <TH> Supprimer </TH>
                            <TH> Captures </TH>
                        </TR>

                        @foreach ($userList ?? '' as $users)
                            <TR id='tab_content_{{$users->id}}'>
                                <TH> {{$users->id}} </TH>
                                <TD> {{$users->name}} </TD>
                                <TD> {{$users->email}} </TD>
                                <TD> ******** </TD>
                                <TD> @if($users->is_admin === 1)
                                        OUI
                                     @else
                                        NON
                                     @endif
                                </TD>
                                <TD>
                                    <div class="container">

                                        <!-- Button to Open the Modal -->
                                        <div class='adminpage_nav_button'>
                                            <button type="button" data-toggle="modal" data-target="#userEditModal{{$users->id}}">✎</button>
                                        </div>
                                        <!-- The Modal -->
                                        <div class="modal fade" id="userEditModal{{$users->id}}">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                              <!-- Modal Header -->
                                              <div class="modal-header">
                                                <h4 class="modal-title">Editer {{$users->name}}</h4>
                                              </div>

                                              <!-- Modal body -->
                                              <div class="modal-body">
                                                <form method="post" action="{{route('edit_user', ['id'=>$users->id])}}" id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                                    @csrf
                                                    <div class='form_content_input'>
                                                        <label class='inline'>Nom :</label>
                                                        <input type="text" name="user_name" class='inline' value="{{$users->name}}"/>
                                                    </div>
                                                    <div class='form_content_input'>
                                                        <label class='inline'>E-mail</label>
                                                        <input type="email" name="user_email" class='inline' value="{{$users->email}}"/>
                                                    </div>
                                                    <div class='form_content_input'>
                                                        <label class='inline'>Mot de passe</label>
                                                        <input type="text" name="user_password" class='inline' value="" placeholder="********"/>
                                                    </div>
                                                    <div class='form_content_input_last'>
                                                        <label class='inline'>Admin</label>
                                                        <select id="isadmin" name="user_isadmin" class='inline'>
                                                            <option value="{{$users->is_admin}}">
                                                                @if($users->is_admin === 1)
                                                                Oui
                                                             @else
                                                                Non
                                                             @endif
                                                                (initial)
                                                            </option>
                                                            <option value="0">Non</option>
                                                            <option value="1">Oui</option>
                                                        </select>
                                                        {{-- <input type="text" name="user_isadmin" class='inline' value="{{$users->is_admin}}"/> --}}
                                                    </div>
                                                    <input type="hidden" name="user_id" value="{{$users->id}}"/>
                                              </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" id="bouton_envoyer" class='edit_user'>Modifier</button>
                                                    </form>
                                                </div>

                                            </div>
                                          </div>
                                        </div>

                                      </div>
                                </TD>
                                <TD>
                                    <div class='adminpage_nav_button'>
                                        <button type="button" data-toggle="modal" class='del_user_button' data-target="#SupprimerLuiModal{{$users->id}}">x</button>
                                        <!-- SUPPRIMER CE POKEMON Modal -->
                                            <!-- The Modal -->
                                            <div class="modal fade" id="SupprimerLuiModal{{$users->id}}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Êtes vous certain de vouloir retirer {{$users->name}} des utilisateurs ?</h4>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body" style="text-align: center;">
                                                            <div class="homepage_nav_button">
                                                                <a data-dismiss='modal' href="{{route('delete_user', ['id'=>$users->id])}}" class='del_user' data-id="{{$users->id}}">Oui</a>
                                                            </div>
                                                            <div class="homepage_nav_button">
                                                                <button type="submit" id="bouton_envoyer" data-dismiss="modal" class='are_you_sure_m808'>Non</button>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </TD>
                                <TD>
                                    <form method="post" action="{{route('my_pokemons')}}" class='gerer_ce_mec' id="formulaire_de_contact"> <!-- Redirige sur la page create de la todolist après submit -->
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$users->id}}"/>

                                        <div class='adminpage_nav_button'>
                                            <button type="submit" id="bouton_envoyer">Gérer</button>
                                        </div>
                                    </form>
                                </TD>
                            </TR>
                        @endforeach
                    </TABLE>
                </div>
                    <!-- Button to Open the Modal -->
                    <div class='adminpage_nav_button_add'>
                        <button type="button" data-toggle="modal" data-target="#userAddModal">Ajouter un utilisateur</button>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="userAddModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Ajouter un utilisateur</h4>
                                </div>

                                <!-- Modal body -->
                                    <div class="modal-body">
                                        <form method="post" action="{{route('add_user')}}" class="formulaire"> <!-- Redirige sur la page create de la todolist après submit -->
                                            @csrf
                                            <div class='form_content_input'>
                                                <label class='inline'>Nom :</label>
                                                <input type="text" name="user_name" class='inline' value="" placeholder="ex: Dany Capitaine" required/>
                                            </div>

                                            <div class='form_content_input'>
                                                <label class='inline'>E-mail</label>
                                                <input type="email" name="user_email" class='inline' value="" placeholder="ex: danycapitaine@gmail.com" required/>
                                            </div>

                                            <div class='form_content_input'>
                                                <label class='inline'>Mot de passe</label>
                                                <input type="text" name="user_password" class='inline' value="" placeholder="********" required/>
                                            </div>

                                            <div class='form_content_input_last'>
                                                <label class='inline'>Admin</label>
                                                <select id="isadmin" name="user_isadmin" class='inline'>
                                                    <option value="0">Non</option>
                                                    <option value="1">Oui</option>
                                                </select>
                                            </div>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class='add_user'>Ajouter</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

    </div>
    <a href='../' class='return_button_thing'>← Retour</a>
    <a href='../' class='return_button_thing_responsive'>←</a>
    @endsection

</main>
@extends('layouts.html_footer')

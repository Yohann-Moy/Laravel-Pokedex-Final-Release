<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::post('/place_d_echange', 'PokedexController@displayToExchangedPokemons')->name('place_d_echange');
Route::post('/recuperer_un_pokemon', 'PokedexController@getAPokemonBack')->name('recuperer_un_pokemon');
Route::post('/envoyer_un_pokemon', 'PokedexController@sendAPokemonToTheMarketPlace')->name('envoyer_un_pokemon');

Route::post('/my_pokemons&exchange=success', 'PokedexController@echangeAction')->name('realiser_l_echange');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pokedex', 'PokedexController@displayAllPokemons')->name('pokedex'); /* On crée une route qui fait l'action display du TaskController dont la methode à pour nom display */

Route::post('/juste_les_pokemons', 'PokedexController@add_a_pokemon_action')->name('juste_les_pokemons');

/* Route::post('/edit_un_pokemon={id}', 'PokedexController@update_action')->name('edit_un_pokemon'); */

// AJAX //
Route::post('/pokedex/release_pokemon', 'PokedexController@release_a_pokemon_action_ajax')->name('release_pokemon_ajax');

/* // NORMAL //
Route::get('/pokedex/release_pokemon={id}', 'PokedexController@release_a_pokemon_action')->name('release_pokemon'); */

// Routes réservées aux utilisateurs authentifiés //
Route::group(['middleware'=>['auth']], function(){

    /* Route::post('/my_pokemons/surnom', 'PokedexController@displayOnePkmn')->name('change_pokemon_name'); */

    // Si ca ne fonctionne pas, le déplacer hors de la parenthèse //
    Route::post('/my_pokemons/nickname_changed', 'PokedexController@changerPkmnSurnomAction')->name('change_pokemon_name_action');

    Route::post('/my_pokemons', 'PokedexController@displayPersonnalPokemonList')->name('my_pokemons');
    Route::post('/pokedex/catch_action_pokemon={id}-user_id={user_id}', 'PokedexController@catch_a_pokemon_action')->name('catch_this_pokemon');
});

// Déplacer ici //

// Routes réservées aux administrateurs //
Route::group(['middleware'=>['auth', 'admin']], function(){

    //AFFICHER TOUS LES UTILISATEURS //
    Route::get('/pokedex/admin_users', 'UserController@afficher_tous_les_users')->name('admin_users');

    Route::post('/pokedex/add_user', 'UserController@add_user')->name('add_user');
    Route::post('/pokedex/edit_user={id}', 'UserController@edit_this_user')->name('edit_user');
    Route::post('/pokedex/delete_user', 'UserController@delete_this_user')->name('delete_user');

    Route::post('/pokedex/add_pokemon_to_a_user', 'UserController@add_pokemon_to_a_user')->name('add_pokemon_to_a_user');

    // AJOUTER UN POKEMON//
    Route::get('/pokedex/ajouter', 'PokedexController@add_a_pokemon')->name('add_pokemon');
    Route::post('/pokedex/add_pkmn', 'PokedexController@add_a_pokemon_action')->name('add_pkmn');

    // MODIFIER UN POKEMON//
/*     Route::get('/pokedex/update_pokemon={id}', 'PokedexController@update_pokemon')->name('update_pokemon'); */


    Route::post('/pokedex/update_pkmn={id}', 'PokedexController@update_action')->name('update_pkmn');

    //SUPPRIMER UN POKEMON//

    // AJAX //
    Route::post('/pokedex/delete_pokemon', 'PokedexController@delete_action')->name('delete_pkmn');

    //NORMAL //
    Route::get('/pokedex/delete={id}', 'PokedexController@delete_a_pokemon')->name('delete_pokemon');
});

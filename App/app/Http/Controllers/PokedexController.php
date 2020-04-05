<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pokemon;
use App\PokemonUser;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class PokedexController extends Controller
{

/*     public function displayAllPokemons (){
        $pokemonVar = Pokemon::all()->sortBy("numero");; // SELECT ALL FROM POKEMONS ORDER BY NUMERO// Pokemon fait référence à la classe Pokemon dans Pokemon.php
        return view('pokedex', ['pokemon' => $pokemonVar]); /* On display la vue pokemon*/
   // }


    public function displayAllPokemons (){
        $pokemonVar = Pokemon::all()->sortBy("numero"); // SELECT ALL FROM POKEMONS ORDER BY NUMERO// Pokemon fait référence à la classe Pokemon dans Pokemon.php
        $pokemonUserTableVar = DB::table('pokemon_user')->select('*')->get();
        return view('pokedex', ['pokemon' => $pokemonVar, 'pokemonUserTable' => $pokemonUserTableVar]); /* On display la vue pokemon*/
    }

    public function displayToExchangedPokemons (Request $request){
        $toExchangePkmnList =

        DB::table('pokemon')
        ->join('pokemon_user', 'pokemon.id', '=', 'pokemon_user.pokemon_id')
        ->select('*', 'pkmn_surnom')
        ->where('echange','=', 1)
        ->get();


        $selectAllUsers =
        DB::table('users')
        ->select('*')
        ->get();

        $row_id = $request->post('row_id');

        $getPokemonSurnom =
        DB::table('pokemon_user')
        ->select('*')
        ->where('id','=', $row_id)
        ->get();

        $pokemon_id = $request->post('pokemon_id');

        $getPokemonName =
        DB::table('pokemon')
        ->select('*')
        ->where('id','=', $pokemon_id )
        ->get();

        $getPokemonCatchID =
        DB::table('pokemon_user')
        ->select('*')
        ->where('pokemon_id','=', $pokemon_id )
        ->where('id','=',$row_id)
        ->get();

        $getIfThereAreSomePokemonsToExchangeExceptMe =
        DB::table('pokemon_user')
        ->select('*')
        ->get();

        return view('exchange_place', [
            'toExchangePokemonList' => $toExchangePkmnList,
            'trainersList' => $selectAllUsers,
            'pokemonSurnom' => $getPokemonSurnom,
            'pokemonEspece' => $getPokemonName,
            'pokemonCatchID' => $getPokemonCatchID,
            'getPokemonsDeposesByOthers' => $getIfThereAreSomePokemonsToExchangeExceptMe
            ]); /* On display la vue avec les pokemons a echanger*/
    }

    public function echangeAction(Request $request){
        $pokemon_a_echanger_row_ID = $request->post('pokemon_echange_row_id'); // Pokemon en cache // 27
        $pokemon_propose_row_ID = $request->post('pokemon_propose_row_id');
        $pokemon_propose_user_ID = $request->post('pokemon_propose_user_id');


        $echangeMaPropositionActionReq2 =
        DB::table('pokemon_user')
        ->where('id','=', $pokemon_propose_row_ID)
        ->update(['user_id' => Auth::user()->id, 'echange' => 0, 'notification' => 1]);

        $echangeMaPropositionActionReq =
        DB::table('pokemon_user')
        ->where('id','=', $pokemon_a_echanger_row_ID)
        ->update(['user_id' => $pokemon_propose_user_ID, 'echange' => 0, 'notification' => 1]);

        $user_id = Auth::user()->id;
        $personnalPkmnListAction =

             DB::table('pokemon')
            ->join('pokemon_user', 'pokemon.id', '=', 'pokemon_user.pokemon_id')
            ->select('*','pkmn_surnom')
            ->where('pokemon_user.user_id','=', Auth::user()->id)
            ->get();

            // REQUETE BRUTE //
           // DB::select(DB::raw('select * from pokemon as pk inner join pokemon_user as pus on pk.id = pus.pokemon_id where pus.user_id="3"'));

        $select_user_name =

            DB::table('users')
            ->select('*')
            ->where('id','=', Auth::user()->id)
            ->get();

        $select_all_pokemons_nom =

            DB::table('pokemon')
            ->select('*')
            ->get();

//            return redirect (route ('my_pokemons', ['personnalPokedex' => $personnalPkmnListAction, 'diplayUserName'=> $select_user_name, 'displayPokemonName'=>$select_all_pokemons_nom]));
        return view('personnal_pokedex', ['personnalPokedex' => $personnalPkmnListAction, 'diplayUserName'=> $select_user_name, 'displayPokemonName'=>$select_all_pokemons_nom]);

        /* return view('welcome'); */

    }

    public function getAPokemonBack(Request $request){

        $row_id = $request->post('row_id');

        $getItBack =
        DB::table('pokemon_user')
        ->where('id','=', $row_id)
        ->update(['echange' => 0]);

        return $getItBack;
    }

    public function sendAPokemonToTheMarketPlace(Request $request){

        $row_id = $request->post('row_id');

        $sendIt =
        DB::table('pokemon_user')
        ->where('id','=', $row_id)
        ->update(['echange' => 1]);

        return $sendIt;
    }

    public function displayOnePokemon ($id){
        $getapokemonVar = Pokemon::where('id', '=', $id)->get(); // SELECT ALL FROM POKEMONS ORDER BY NUMERO// Pokemon fait référence à la classe Pokemon dans Pokemon.php
        return view('catch_pokemon', ['getaPokemon' => $getapokemonVar]); /* On display la vue*/
    }

/*     public function displayPersonnalPokemonList(Request $request){
        // SELECT ALL FROM POKEMON WHERE USER_ID == USER_ID DE L'UTILISATEUR CONNECTÉ //
        $personnalPkmnListAction = Pokemon::where('user_id', '=', ($request->post('user_id')))->get();
        return view('personnal_pokedex', ['personnalPokedex' => $personnalPkmnListAction]); /* On display la vue et les pokemons en fonction du de la valeur du hidden input qui a pour name user_id */
/*     } */

    public function changerPkmnSurnom (){
        return view('change_pkmn_name');
    }

    public function displayOnePkmn(Request $request){

        $personnalPkmnListAction =

        DB::table('pokemon')
        ->join('pokemon_user', 'pokemon.id', '=', 'pokemon_user.pokemon_id')
        ->select('*', 'pkmn_surnom')
        ->where('pokemon_user.id','=', ($request->post('pkmn_id')))
        ->get();

        return view('change_pkmn_name', ['personnalPokedex' => $personnalPkmnListAction]);
    }

    public function changerPkmnSurnomAction(Request $request){
            $old_surnom = $request->post('old_nickname');
            $new_surnom = $request->post('pkmn_new_surnom'); // Récupération du surnom depuis le formulaire //

            if($new_surnom == ''){ // Si aucun nouveau surnom n'est saisi //
                $new_surnom = $old_surnom;
            }

            $table_id = $request->post('id'); // ICI PROBLEME //

            $ChangeSurnomPokemon =

            DB::table('pokemon_user')
            ->where('id', $table_id)
            ->update(['pkmn_surnom' => $new_surnom]);

            $user_id = $request->post('user_id');

            return $ChangeSurnomPokemon;

    }

        public function displayPersonnalPokemonList(Request $request){
        $user_id = $request->post('user_id');
        $personnalPkmnListAction =

             DB::table('pokemon')
            ->join('pokemon_user', 'pokemon.id', '=', 'pokemon_user.pokemon_id')
            ->select('*','pkmn_surnom')
            ->where('pokemon_user.user_id','=', ($request->post('user_id')))
            ->get();

            // REQUETE BRUTE //
           // DB::select(DB::raw('select * from pokemon as pk inner join pokemon_user as pus on pk.id = pus.pokemon_id where pus.user_id="3"'));

        $select_user_name =

            DB::table('users')
            ->select('*')
            ->where('id','=', ($request->post('user_id')))
            ->get();

        $select_all_pokemons_nom =

            DB::table('pokemon')
            ->select('*')
            ->get();


            return view('personnal_pokedex', ['personnalPokedex' => $personnalPkmnListAction, 'diplayUserName'=> $select_user_name, 'displayPokemonName'=>$select_all_pokemons_nom]);
    }


    // Compter le nombre de pokemons associés au même user_id et en fonction de celui ci (requete en post)
    // rediriger sur la page welcome. Si un pokemon appartient au user_id == Auth::user()->id alors afficher bouton consuler pokedex perso


/*     public function update_pokemon($id){
        $editPokemonVar = Pokemon::find($id); // SELECT ID POKEMON FROM POKEMON //
        return view('modifier_pokemon', ['editPokemon' => $editPokemonVar]);
    } */

    public function update_action(Request $request, $id){

        // Récupère ces infos depuis la section data de l'AJAX
        $table_id = $request->post('table_id');
        $pkmn_numero = $request->post('pokemon_id');
        $pkmn_nom = $request->post('pokemon_nom');
        $pkmn_type1 = $request->post('pokemon_type1');
        $pkmn_type2 = $request->post('pokemon_type2');
        $pkmn_sprite = $request->post('pokemon_sprite');

        // Gère l'exception de champs non remplis dans la modale //
        if($pkmn_numero == ''){$pkmn_numero = 000;}
        if($pkmn_nom == ''){$pkmn_nom = 'MissingN0';}
        if($pkmn_type1 == ''){$pkmn_type1 = '/';}
        if($pkmn_type2 == ''){$pkmn_type2 = '/';}
        if($pkmn_sprite == ''){$pkmn_sprite = '/img/missingno.png';}

        // Requete SQL
        $editPokemonAction =
        DB::table('pokemon')
        ->where('id', $table_id)
        ->update(['numero' => $pkmn_numero, 'nom'=> $pkmn_nom, 'type1'=>$pkmn_type1, 'type2'=>$pkmn_type2, 'image'=>$pkmn_sprite]);

        // Retourne le résultat de la requete SQL en boolean //
        /* return $editPokemonAction; */
        $pokemonVar = Pokemon::all()->sortBy("numero");

        $returnHTML = view('juste_les_pokemons',['pokemon'=> $pokemonVar])->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML));
    }

/*     public function add_a_pokemon (){
        return view('ajouter_pokemon');
    } */

    public function add_a_pokemon_action (Request $request){
        $addPokemonAction = new Pokemon();
        //$addPokemonAction->nom = ($request->post('nom')) ? Si il y a un nom alors $request->post('nom') : Sinon $addPokemonAction->nom;
        $addPokemonAction->nom = ($request->post('pokemon_nom')) ? $request->post('pokemon_nom') : 'MissingN0'; /* On affecte une valeur à la colonne Titre en fonction des values du champ titre du formulaire ET Si c'est NULL alors on ne modifie rien*/
        $addPokemonAction->numero = ($request->post('pokemon_id')) ? $request->post('pokemon_id') : '0';
        $addPokemonAction->type1 = ($request->post('pokemon_type1')) ? $request->post('pokemon_type1') : 'Vol';
        $addPokemonAction->type2 = ($request->post('pokemon_type2')) ? $request->post('pokemon_type2') : '/';
        $addPokemonAction->image = ($request->post('pokemon_sprite')) ? $request->post('pokemon_sprite') : '/img/missingno.png';

        $addPokemonAction->save();

        $pokemonVar = Pokemon::all()->sortBy("numero"); // SELECT ALL FROM POKEMONS ORDER BY NUMERO// Pokemon fait référence à la classe Pokemon dans Pokemon.php
        /* return $addPokemonAction; */
        $returnHTML = view('juste_les_pokemons',['pokemon'=> $pokemonVar])->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML));
        // return view('pokedex');
        /* return redirect (route ('pokedex')); // Redirige sur la page du pokedex // */
    }


    // CATCH POKEMON ACTION //
    public function catch_a_pokemon_action(Request $request){
        $userID = $request->post('user_id'); // Récupéré le data de l'AJAX
        $pokemonID = $request->post('pokemon_id'); // Récupéré le data de l'AJAX

        $catchPokemonAction =

        DB::table('pokemon_user')
        ->insert(
            ['pokemon_id' => $pokemonID, 'user_id' => $userID, 'origin_trainer' => Auth::user()->name]
        );

        return (string)$catchPokemonAction;
    }


/*     // RELACHER UN POKEMON NORMAL //
    public function release_a_pokemon_action($id){
        $releasePokemonAction =

        DB::table('pokemon_user')
        ->where('id', '=', $id)
        ->delete();

        return view ('welcome');
    } */

    // RELACHER UN POKEMON AJAX //
    public function release_a_pokemon_action_ajax(Request $request){
        $id = $request->post('id');

        $releasePokemonAction =

        DB::table('pokemon_user')
        ->where('id', '=', $id)
        ->delete();

        return $releasePokemonAction;
    }

/* // AJAX INITIALE //
    public function delete_action(Request $request){
        $dropPokemonAction = Pokemon::find($request->post('id')); // Récupération par ID dynamique
        $dropPokemonAction->delete(); // Supression du tuple qui a pour ID //
        return $dropPokemonAction; // Redirige sur la page home de la todolist //
    } */

    // AJAX //
    public function delete_action(Request $request){
        $dropPokemonAction = Pokemon::find($request->post('id')); // Récupération par ID dynamique
        $dropPokemonAction->delete(); // Supression du tuple qui a pour ID //

        $id = $request->post('id');

        $cleanPokemonDB =

        DB::table('pokemon_user')
        ->select('*')
        ->where('pokemon_id','=', $id)
        ->delete();

        return $cleanPokemonDB;
        return $dropPokemonAction;
    }


// Classique //
    public function delete_a_pokemon($id){
        $deletePokemon = Pokemon::find($id);
        $deletePokemon->delete();
        return redirect (route ('pokedex'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     // Intelligeance de la vue //


}

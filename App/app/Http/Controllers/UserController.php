<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function afficher_tous_les_users (){
        $allUsersDisplay =

        DB::table('users')
        ->select('*')
        ->whereNotIn('id', [Auth::id()])
        ->orderBy("is_admin", 'desc')
        ->get();

        return view('admin_utilisateurs', ['userList' => $allUsersDisplay]);
    }


    public function add_user(Request $request){
        $user_id = $request->post('user_id');
        $new_name = $request->post('user_name');
        $new_mail = $request->post('user_email');

        if($request->post('user_password') != ''){
            $new_password = Hash::make($request->post('user_password'));
        }

        else{
            $new_password = Hash::make('root');
        }

        $new_admin = $request->post('user_isadmin');

        $addUser =

        DB::table('users')
        ->insert(['name' => $new_name, 'email' => $new_mail, 'password' => $new_password, 'is_admin' => $new_admin]);

        return redirect (route ('admin_users'));
    }

    public function add_pokemon_to_a_user(Request $request){

        $pokemon_id = $request->post('select_pokemon');
        $pokemon_surnom = '/';
        $user_id = $request->post('user_id');

        $addPokemonToUser =

        DB::table('pokemon_user')
        ->insert(['pokemon_id' => $pokemon_id, 'pkmn_surnom'=>$pokemon_surnom, 'user_id'=>$user_id]);

        $personnalPkmnListAction =

             DB::table('pokemon')
            ->join('pokemon_user', 'pokemon.id', '=', 'pokemon_user.pokemon_id')
            ->select('*','pkmn_surnom')
            ->where('pokemon_user.user_id','=', ($request->post('user_id')))
            ->get();

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

    public function edit_this_user(Request $request){
        $user_id = $request->post('user_id');
        $new_name = $request->post('user_name');
        $new_mail = $request->post('user_email');

        if($request->post('user_password') != ''){
            $new_password = Hash::make($request->post('user_password'));
            $editThisUserMDP =

            DB::table('users')
            ->where('id','=', $user_id)
            ->update(['password' => $new_password]);
        }

        else{}

        $new_admin = $request->post('user_isadmin');

        $editThisUser =

        DB::table('users')
        ->where('id','=', $user_id)
        ->update(['name' => $new_name, 'email' => $new_mail, 'is_admin' => $new_admin]);

        return redirect (route ('admin_users'));
    }

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
            return $dropPokemonAction; // Redirige sur la page home de la todolist //
        }

    public function delete_this_user(Request $request){
        $dropUserAction = User::find($request->post('id'));
        $dropUserAction->delete();

        $user_id = Auth::id();

        $cleanUserDB =

        DB::table('pokemon_user')
        ->select('*')
        ->where('user_id','=', $request->post('id'))
        ->delete();

        return $cleanUserDB;
        return $dropUserAction;
    }

/*     public function get_user_name(Request $request){
        DB::table('users')
        ->select('name')
        ->where('id','=', $request->post('id'))
        ->get();

        return view('my_pokemons', ['userName' => $allUsersNames]);
    } */

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

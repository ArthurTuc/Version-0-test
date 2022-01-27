<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Categorie;

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
    return view('index');
});

Route::get('accueil', function () {
    return view('accueil');
});

Route::get('liste', function (Request $request) {
    $livres = Livre::join('categories', 'categorie_id', '=', 'categories.id')->get();
    return view('liste_livres',["livres"=>$livres]);
});

// -- "liste des livres" du menu
// Route::get('liste', function (Request $request) {
//     // -- iste des livres (toutes les infos) :
//     $livres = Livre::get();
//     return view('liste_livres',["livres"=>$livres]);
//    });

Route::get('meslivres', function (Request $request) {
    $id = Auth::user()->id;
    $livres = Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select('livres.id','livres.titre','livres.resume','livres.prix','categories.libelle')->get();
    //dump($livres);
    return view('meslivres',["livres"=>$livres]);
});

Route::get('ajouter', function (Request $request) {
    $cats = Categorie::get();
    return view('ajout_livre',["cats"=>$cats]);
});

Route::get('ajout', function (Request $request) {
    $livres = new Livre;
    $livres -> titre = $request->input('titre');
    $livres -> resume = $request->input('resume');
    $livres -> prix = $request->input('prix');
    $livres -> categorie_id = $request->input('categorie');
    $id = Auth::user()->id;
    $livres -> user_id = $id;
    $livres->save();
    if ($livres) {$message = "Livre ajouté !";}
    $livres = Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select('livres.id','livres.titre','livres.resume','livres.prix','categories.libelle')->get();
    // if ($livres->fails()) {
    //     return $livres->errors();
    //     }
    // else { $message = "Livre ajouté !";}
    return view('liste_livres',["livres"=>$livres, 'message'=>$message]);
});

Route::get('recherche', function (Request $request) {
    $search = $request->input('search');
    $livres = Livre::where('titre', 'like', '%' .$request->input('search'). '%')->get();
    return view('resultat_recherche',["livres"=>$livres, "search"=>$search]);
});

Route::get('modifier', function (Request $request) {
    $idlivre = $request->input('id');
    $livre = Livre::find($idlivre);
    $cats = Categorie::get();
    return view('modif_livre', ["livre"=>$livre, "cats"=>$cats]);
});

Route::get('valider_modif', function (Request $request) {
    $livres = Livre::find($request->input('id'));
    $livres -> titre = $request->input('titre');
    $livres -> resume = $request->input('resume');
    $livres -> prix = $request->input('prix');
    $livres -> categorie_id = $request->input('categorie');
    $livres ->save();
    $id = Auth::user()->id;
    $livres = Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select('livres.id','livres.titre','livres.resume','livres.prix','categories.libelle')->get();
    return view('meslivres', ["livres"=>$livres]);
});

Route::get('supprimer', function (Request $request) {
    $livre = Livre::find($request->input('id'));
    $livre -> delete();
    $id = Auth::user()->id;
    $livres = Livre::join('categories', 'categorie_id', '=', 'categories.id')->where('user_id', $id)->select('livres.id','livres.titre','livres.resume','livres.prix','categories.libelle')->get();
    return view('meslivres', ["livres"=>$livres]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
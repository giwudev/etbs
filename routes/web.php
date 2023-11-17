<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HomeController;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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

//Contrôler du site

// Route::get('/',[App\Http\Controllers\SiteController::class, 'index']);

// Route::get('/registerUsager',[App\Http\Controllers\SiteController::class, 'registre_usager']);
// Route::get('/logoutAgent',[App\Http\Controllers\SiteController::class, 'LogoutAgent']);
//
Route::get('/clear', function(){
	Artisan::call('config:cache');
	Artisan::call('route:clear');
});

//Code Perso à ne pas supprimer 
Route::get('/check', function(){
	$user = User::find(1);
	if($user->created_at > '2023-10-26 00:00:00'){
		return response()->json('oui');
	}
	return response()->json('non');
});

Auth::routes();

Route::get('/', function () {return redirect()->route('home');}); // redirection vers la page home si la ligne delete

// Route::get('/',[App\Http\Controllers\SiteController::class, 'index']);
Route::get('weberror',[App\Http\Controllers\GiwuController::class, 'weberror']);

Route::group(['middleware' =>'App\Http\Middleware\GiwuMiddleware'],function(){

	Route::group(['middleware' => 'auth'],function(){
		Route::get('manuel', [App\Http\Controllers\GiwuController::class, 'AfficherAideGiwu']);
		Route::get('chargeEcole', [App\Http\Controllers\GiwuController::class, 'ChargerIDEcole']);
	
		Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
		Route::get('myprofile',[App\Http\Controllers\GiwuController::class, 'AfficherProfile']);
		Route::get('mysociety',[App\Http\Controllers\GiwuController::class, 'AfficherMySociete']);
		Route::match(['get','post'],'mysociety/updatepage',[App\Http\Controllers\GiwuController::class, 'UpdatePageSoc']);
	
		Route::match(['get','post'],'updateprofil',[App\Http\Controllers\GiwuController::class, 'UpdatePageProfile']);
		Route::match(['get','post'],'updatemdp',[App\Http\Controllers\GiwuController::class, 'UpdatePageMotDpas']);
		//User
		Route::get('users/AffichePopDelete/{code}',[App\Http\Controllers\UserController::class, 'AffichePopDelete']);
		Route::get('users/exporterExcel',[App\Http\Controllers\UserController::class, 'exporterExcel']);
		Route::get('users/exporterPdf',[App\Http\Controllers\UserController::class, 'exporterPdf']);
		Route::get('users/AffichePopAction/{id}',[App\Http\Controllers\UserController::class, 'AffichePopAction']);
		Route::get('users/findPromo/{id}',[App\Http\Controllers\UserController::class, 'findPromo']);
		Route::post('users/importProf', 'App\Http\Controllers\UserController@importProf')->name('users.importProf');
	
		//Menu
		Route::get('menu/AffichePopDelete/{id}',[App\Http\Controllers\MenuController::class, 'AffichePopDelete']);
		Route::get('menu/AffichePopAction/{id}',[App\Http\Controllers\MenuController::class, 'AffichePopAction']);
		Route::post('menu/actionUpdate',[App\Http\Controllers\MenuController::class, 'AjouterGiwuAction']);
		Route::post('menu/actionDelete',[App\Http\Controllers\MenuController::class, 'DeleteGiwuAction']);
		//Role
		Route::get('role/AffichePopDelete/{code}',[App\Http\Controllers\RoleController::class, 'AffichePopDelete']);
		//Trace
		Route::get('trace/exporterExcel',[App\Http\Controllers\SaveTraceController::class, 'exporterExcel']);
		Route::get('trace/exporterPdf',[App\Http\Controllers\SaveTraceController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   ECOLE
		|--------------------------------------------------------------------------
		*/
		Route::get('ecole/AffichePopDelete/{id}',[App\Http\Controllers\EcoleController::class, 'AffichePopDelete']);
		Route::get('ecole/exporterExcel',[App\Http\Controllers\EcoleController::class, 'exporterExcel']);
		Route::get('ecole/exporterPdf',[App\Http\Controllers\EcoleController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   ANNEESCO
		|--------------------------------------------------------------------------
		*/
		Route::get('anneesco/AffichePopDelete/{id}',[App\Http\Controllers\AnneescoController::class, 'AffichePopDelete']);
		Route::get('anneesco/exporterExcel',[App\Http\Controllers\AnneescoController::class, 'exporterExcel']);
		Route::get('anneesco/exporterPdf',[App\Http\Controllers\AnneescoController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   TRIMSEM
		|--------------------------------------------------------------------------
		*/
		Route::get('trimsem/AffichePopDelete/{id}',[App\Http\Controllers\TrimsemController::class, 'AffichePopDelete']);
		Route::get('trimsem/exporterExcel',[App\Http\Controllers\TrimsemController::class, 'exporterExcel']);
		Route::get('trimsem/exporterPdf',[App\Http\Controllers\TrimsemController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   CLASSE
		|--------------------------------------------------------------------------
		*/
		Route::get('classe/AffichePopDelete/{id}',[App\Http\Controllers\ClasseController::class, 'AffichePopDelete']);
		Route::get('classe/exporterExcel',[App\Http\Controllers\ClasseController::class, 'exporterExcel']);
		Route::get('classe/exporterPdf',[App\Http\Controllers\ClasseController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   PROMOTION
		|--------------------------------------------------------------------------
		*/
		Route::get('promotion/AffichePopDelete/{id}',[App\Http\Controllers\PromotionController::class, 'AffichePopDelete']);
		Route::get('promotion/exporterExcel',[App\Http\Controllers\PromotionController::class, 'exporterExcel']);
		Route::get('promotion/exporterPdf',[App\Http\Controllers\PromotionController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   DISCIPLINE
		|--------------------------------------------------------------------------
		*/
		Route::get('discipline/AffichePopDelete/{id}',[App\Http\Controllers\DisciplineController::class, 'AffichePopDelete']);
		Route::get('discipline/exporterExcel',[App\Http\Controllers\DisciplineController::class, 'exporterExcel']);
		Route::get('discipline/exporterPdf',[App\Http\Controllers\DisciplineController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   ELEVE
		|--------------------------------------------------------------------------
		*/
		Route::get('eleve/AffichePopDelete/{id}',[App\Http\Controllers\EleveController::class, 'AffichePopDelete']);
		Route::get('eleve/exporterExcel',[App\Http\Controllers\EleveController::class, 'exporterExcel']);
		Route::get('eleve/exporterPdf',[App\Http\Controllers\EleveController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   EMPLOITEMP
		|--------------------------------------------------------------------------
		*/
		Route::get('emploitemp{type}/AffichePopDelete/{id}',[App\Http\Controllers\EmploitempController::class, 'AffichePopDelete']);
		Route::get('emploitemp{type}/exporterExcel',[App\Http\Controllers\EmploitempController::class, 'exporterExcel']);
		Route::get('emploitemp{type}/exporterPdf',[App\Http\Controllers\EmploitempController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   FREQUENTER
		|--------------------------------------------------------------------------
		*/
		Route::get('frequenter/AffichePopDelete/{id}',[App\Http\Controllers\FrequenterController::class, 'AffichePopDelete']);
		Route::get('frequenter/AffichePopDeletePromo',[App\Http\Controllers\FrequenterController::class, 'AffichePopDeletePromo']);
		Route::post('frequenter/DeletePromo',[App\Http\Controllers\FrequenterController::class, 'DeletePromo']);
		Route::get('frequenter/pop-up',[App\Http\Controllers\FrequenterController::class, 'AffichePopUp']);
		Route::get('frequenter/exporterExcel',[App\Http\Controllers\FrequenterController::class, 'exporterExcel']);
		Route::get('frequenter/exporterPdf',[App\Http\Controllers\FrequenterController::class, 'exporterPdf']);
		Route::get('frequenter/AffichePopAction/{id}',[App\Http\Controllers\FrequenterController::class, 'AffichePopAction']);
		// Route::post('frequenter/importEleve',[App\Http\Controllers\FrequenterController::class, 'importEleve']);
		Route::post('frequenter/importEleve', 'App\Http\Controllers\FrequenterController@importEleve')->name('frequenter.importEleve');
	
	
	
	
			/*
		|--------------------------------------------------------------------------
		|   APPELER
		|--------------------------------------------------------------------------
		*/
		Route::get('appeler/exporterExcel',[App\Http\Controllers\AppelerController::class, 'exporterExcel']);
		Route::get('appeler/exporterPdf',[App\Http\Controllers\AppelerController::class, 'exporterPdf']);
		Route::get('appeler/confirmer/{id}',[App\Http\Controllers\AppelerController::class, 'ConfirmerPresence']);
		Route::get('appeler/AffichePopAction/{id}',[App\Http\Controllers\AppelerController::class, 'AffichePopAction']);
		Route::post('appeler/actionAddJust',[App\Http\Controllers\AppelerController::class, 'AddJustif']);
		/*
		|--------------------------------------------------------------------------
		|   LISTNOTECONDUITE
		|--------------------------------------------------------------------------
		*/
		Route::match(['get','post'],'listnoteconduite',[App\Http\Controllers\Cons\ConslistnoteconduiteController::class, 'listnoteconduiteCons']);
		Route::get('listnoteconduite/exporterExcel',[App\Http\Controllers\Cons\ConslistnoteconduiteController::class, 'exporterExcel']);
		Route::get('listnoteconduite/exporterPdf',[App\Http\Controllers\Cons\ConslistnoteconduiteController::class, 'exporterPdf']);
	
			/*
		|--------------------------------------------------------------------------
		|   DEFINIPROMOTION
		|--------------------------------------------------------------------------
		*/
		Route::get('definipromotion/AffichePopDelete/{id}',[App\Http\Controllers\DefinipromotionController::class, 'AffichePopDelete']);
		Route::get('definipromotion/exporterExcel',[App\Http\Controllers\DefinipromotionController::class, 'exporterExcel']);
		Route::get('definipromotion/exporterPdf',[App\Http\Controllers\DefinipromotionController::class, 'exporterPdf']);
	
		//add-route-cms
	
		Route::resource('emploitemp{type}', App\Http\Controllers\EmploitempController::class, ['parameters' => ['emploitemp{type}' => 'id']]);
		Route::resources([
			'users'=>App\Http\Controllers\UserController::class,
			'menu'=>App\Http\Controllers\MenuController::class,
			'role'=>App\Http\Controllers\RoleController::class,
			'trace'=>App\Http\Controllers\SaveTraceController::class,
			'entite'=>App\Http\Controllers\EntiteController::class,
			'ecole'=>App\Http\Controllers\EcoleController::class,
			'anneesco'=>App\Http\Controllers\AnneescoController::class,
			'trimsem'=>App\Http\Controllers\TrimsemController::class,
			'classe'=>App\Http\Controllers\ClasseController::class,
			'promotion'=>App\Http\Controllers\PromotionController::class,
			'discipline'=>App\Http\Controllers\DisciplineController::class,
			'eleve'=>App\Http\Controllers\EleveController::class,
			'frequenter'=>App\Http\Controllers\FrequenterController::class,
			'appeler'=>App\Http\Controllers\AppelerController::class,
			// 'emploitemp{type}'=>App\Http\Controllers\EmploitempController::class,
			'definipromotion'=>App\Http\Controllers\DefinipromotionController::class,
			//resources-giwu
		]);
	});

});


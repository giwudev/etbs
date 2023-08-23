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

Auth::routes();

Route::get('/', function () {return redirect()->route('home');}); // redirection vers la page home si la ligne delete

// Route::get('/',[App\Http\Controllers\SiteController::class, 'index']);
Route::get('weberror',[App\Http\Controllers\GiwuController::class, 'weberror']);

Route::match(['get','post'],'loginagent',[App\Http\Controllers\SiteController::class, 'connexionAgent']);
Route::match(['get','post'],'inscriagent',[App\Http\Controllers\SiteController::class, 'InscriptionAgent']);

Route::group(['middleware' =>'App\Http\Middleware\GiwuMiddleware'],function(){

	Route::get('mypage',[App\Http\Controllers\SiteController::class, 'espaceAgent']);
	Route::get('createdoss/{id}/{type}',[App\Http\Controllers\SiteController::class, 'Aff_CreateDossier']);
	Route::post('AddDossier',[App\Http\Controllers\SiteController::class, 'Aff_CreateAddDossier']);

	Route::get('ParcoursDossier/{id}',[App\Http\Controllers\SiteController::class, 'Aff_ParcoursDossier']);
	Route::match(['get','post'],'dossierAgent',[App\Http\Controllers\SiteController::class, 'CreateDossierAgent']);

});


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
	Route::get('emploitemp/AffichePopDelete/{id}',[App\Http\Controllers\EmploitempController::class, 'AffichePopDelete']);
	Route::get('emploitemp/exporterExcel',[App\Http\Controllers\EmploitempController::class, 'exporterExcel']);
	Route::get('emploitemp/exporterPdf',[App\Http\Controllers\EmploitempController::class, 'exporterPdf']);

		/*
	|--------------------------------------------------------------------------
	|   FREQUENTER
	|--------------------------------------------------------------------------
	*/
	Route::get('frequenter/AffichePopDelete/{id}',[App\Http\Controllers\FrequenterController::class, 'AffichePopDelete']);
	Route::get('frequenter/exporterExcel',[App\Http\Controllers\FrequenterController::class, 'exporterExcel']);
	Route::get('frequenter/exporterPdf',[App\Http\Controllers\FrequenterController::class, 'exporterPdf']);

	//add-route-cms


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
		'emploitemp'=>App\Http\Controllers\EmploitempController::class,
		'frequenter'=>App\Http\Controllers\FrequenterController::class,
		//resources-giwu
    ]);
});


<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class Appeler extends Model {

	protected $table = 'etbs_appeler';
	protected $primaryKey = 'id_appel';
	protected $guarded = array('*');
	public $timestamps = true;


	public function emploitemp(){return $this->belongsTo('App\Models\Emploitemp','emploi_id','id_empl');}

	public function eleve(){return $this->belongsTo('App\Models\Eleve','eleve_id','id_el');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListAppel(Request $req){

		$query = Appeler::with(['emploitemp','eleve','users_g']);
		$emploi_idv = $req->get('emploi_id');
		if(isset($emploi_idv)){
			if($emploi_idv != null && $emploi_idv != '' && $emploi_idv != '-1'){
				Session()->put('emploi_idSess', intval($emploi_idv));
			}
			$query->where('emploi_id',$req->get('emploi_id'));
		}else{
			// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
			//Session()->put('emploi_idSess', '')
			$query->where('emploi_id',session('emploi_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
            // $query->where(function ($query) Use ($recherche){
            //     $query->where('etat_appel','like','%'.strtoupper(trim($recherche).'%'));
            // });			//Recherche avancee sur emploitemp
            // $query->orWhereHas('emploitemp', function ($q) use ($recherche) {
			// });
			// //Recherche avancee sur eleve
			// $query->orWhereHas('eleve', function ($q) use ($recherche) {
			// 	$q->where('nom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
			// 	$q->orwhere('prenom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
			// });

		}
		return $query;
	}

	public static function sltListAppeler(){
		$query = self::all()->pluck('etat_appel','id_appel');
		return $query;
        // session('etablis_idSess')
	}


}


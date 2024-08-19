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

class Paiementprof extends Model {

	protected $table = 'etbs_paiement_prof';
	protected $primaryKey = 'id_paie';
	protected $guarded = array('*');
	public $timestamps = true;


	public function professeur(){return $this->belongsTo('App\Models\User','id_prof','id');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getPaiementProf(Request $req){

		$query = Paiementprof::with(['users_g','users_g'])->where('etablis_id',session('etablis_idSess'))
														->orderBy('created_at','desc');

		$id_profv = $req->get('id_prof');
		if(isset($id_profv)){
			if($id_profv != null && $id_profv != '' && $id_profv != '-1'){
				Session()->put('id_profSess', intval($id_profv));
			}
			$query->where('id_prof',$req->get('id_prof'));
		}else{
			// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
			//Session()->put('id_profSess', '')
			$query->where('id_prof',session('id_profSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){
				$query->where('montant_total','like','%'.strtoupper(trim($recherche).'%'));
			});	
			
			//Recherche avancee sur users
			$query->orWhereHas('users_g', function ($q) use ($recherche) {
				$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

		}
		return $query;
	}

	public static function sltListPaiementprof(){
		$query = self::all()->pluck('datedebut','id_paie');
		return $query;
	}

}


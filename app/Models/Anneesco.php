<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Auth,DB;

class Anneesco extends Model {
	protected $table = 'etbs_annee_sco';
	protected $primaryKey = 'id_annee';
	protected $guarded = array('*');
	public $timestamps = true;


	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public function ecole(){return $this->belongsTo('App\Models\Ecole','etablis_id','id_eco');}

	public static function getListAnnee(Request $req){

		$query = Anneesco::with(['users_g','ecole'])->orderBy('created_at','desc');

		$etablis_idv = $req->get('etablis_id');
		if(isset($etablis_idv)){
			if($etablis_idv != null && $etablis_idv != '' && $etablis_idv != '-1'){
				Session()->put('etablis_idSess', intval($etablis_idv));
			}
			$query->where('etablis_id',$req->get('etablis_id'));
		}else{
			// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
			//Session()->put('etablis_idSess', '')
			$query->where('etablis_id',session('etablis_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){
				$query->orwhere('annee_debut','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('annee_fin','like','%'.strtoupper(trim($recherche).'%'));
			});

			//Recherche avancee sur ecole
			// $query->orWhereHas('ecole', function ($q) use ($recherche) {
			// 	$q->where('nom_eco', 'like', '%'.strtoupper(trim($recherche).'%'));
			// 	$q->orwhere('sigle_eco', 'like', '%'.strtoupper(trim($recherche).'%'));
			// });

		}
		return $query;
	}

	public static function sltListAnneesco(){

		return self::select(DB::raw("CONCAT(annee_debut,' - ',annee_fin) AS annee"),'etbs_annee_sco.id_annee')
							->where('etablis_id',session('etablis_idSess'))
							->distinct()
							->get()->pluck('annee','id_annee');
							
	}

}


<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion;

use Auth;
use Illuminate\Support\Facades\DB;


class Eleve extends Model {

	protected $table = 'etbs_eleve';
	protected $primaryKey = 'id_el';
	protected $guarded = array('*');
	public $timestamps = true;


	public function ecole(){return $this->belongsTo('App\Models\Ecole','ecole_id','id_eco');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListEleve(Request $req){

		$query = Eleve::with(['ecole','users_g'])->orderBy('created_at','desc');

		$ecole_idv = $req->get('ecole_id');
		if(isset($ecole_idv)){
			if($ecole_idv != null && $ecole_idv != '' && $ecole_idv != '-1'){
				Session()->put('ecole_idSess', intval($ecole_idv));
			}
			$query->where('ecole_id',$req->get('ecole_id'));
		}else{
			// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
			//Session()->put('ecole_idSess', '')
			$query->where('ecole_id',session('ecole_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){
					$query->where('nom_el','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('prenom_el','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('matricule_el','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('tuteur_el','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('email_el','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('tel_el','like','%'.strtoupper(trim($recherche).'%'));
				});			//Recherche avancee sur ecole
			$query->orWhereHas('ecole', function ($q) use ($recherche) {
				$q->where('nom_eco', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('sigle_eco', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

			//Recherche avancee sur users
			$query->orWhereHas('users_g', function ($q) use ($recherche) {
				$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

		}
		return $query;
	}

	public static function sltListEleve(){
    $query = self::where('ecole_id', session('etablis_idSess'))->get(['id_el', DB::raw("CONCAT(nom_el, ' ', prenom_el) AS full_name")])->pluck('full_name', 'id_el');
    return $query;
}



}


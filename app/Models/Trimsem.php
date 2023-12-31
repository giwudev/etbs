<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class Trimsem extends Model {

	protected $table = 'etbs_trim_sem';
	protected $primaryKey = 'id_trimSem';
	protected $guarded = array('*');
	public $timestamps = true;
    protected $dates = ['date_debut', 'date_fin'];


	public function anneesco(){return $this->belongsTo('App\Models\Anneesco','annee_id','id_annee');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListTrimSemestre(Request $req){

		$query = Trimsem::with(['anneesco','users_g'])->orderBy('id_trimSem','asc');

		$annee_idv = $req->get('annee_id');
		if(isset($annee_idv)){
			if($annee_idv != null && $annee_idv != '' && $annee_idv != '-1'){
				Session()->put('annee_idSess', intval($annee_idv));
			}
			$query->where('annee_id',$req->get('annee_id'));
		}else{
			$query->where('annee_id',session('annee_idSess'));
		}
		//Controle sur l'etablissement connecte
		$sessionAnne = session('etablis_idSess');
		$query->WhereHas('anneesco', function ($q) use ($sessionAnne) {
			$q->where('etablis_id', $sessionAnne);
		});

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){					
				$query->orwhere('libelle_trimSem','like','%'.strtoupper(trim($recherche).'%'));
				
				$query->orWhereHas('anneesco', function ($q) use ($recherche) {
					$q->where('statut_annee', 'like', '%'.strtoupper(trim($recherche).'%'));
				});
			});			//Recherche avancee sur anneesco

			//Recherche avancee sur users
			// $query->orWhereHas('users_g', function ($q) use ($recherche) {
			// 	$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
			// 	$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			// });

		}
		return $query;
	}

	public static function sltListTrimsem(){
		$query = self::where('annee_id',session('annee_idSess'))
					->pluck('libelle_trimsem','id_trimSem');
		return $query;
	}

}


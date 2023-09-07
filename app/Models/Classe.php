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

class Classe extends Model {

	protected $table = 'etbs_classe';
	protected $primaryKey = 'id_clas';
	protected $guarded = array('*');
	public $timestamps = true;


	public function anneesco(){return $this->belongsTo('App\Models\Anneesco','annee_id','id_annee');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListClasse(Request $req){

		$query = Classe::with(['anneesco','users_g'])->orderBy('created_at','desc');

		$annee_idv = $req->get('annee_id');
		if(isset($annee_idv)){
			if($annee_idv != null && $annee_idv != '' && $annee_idv != '-1'){
				Session()->put('annee_idSess', intval($annee_idv));
			}
			$query->where('annee_id',$req->get('annee_id'));
		}else{
			$query->where('annee_id',session('annee_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){					
				$query->orwhere('libelle_clas','like','%'.strtoupper(trim($recherche).'%'));
			});			//Recherche avancee sur anneesco
			$query->orWhereHas('anneesco', function ($q) use ($recherche) {
				$q->where('statut_annee', 'like', '%'.strtoupper(trim($recherche).'%'));
			});
		}
		return $query;
	}

	public static function sltListClasse(){

		return self::join('etbs_annee_sco','etbs_annee_sco.id_annee','etbs_classe.annee_id')
							->where('etbs_annee_sco.etablis_id',session('etablis_idSess'))
							->where('etbs_annee_sco.id_annee',session('annee_idSess'))
							->select('etbs_classe.*')
							->distinct()
							->get()->pluck('libelle_clas','id_clas');
	}

}


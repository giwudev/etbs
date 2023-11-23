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

class Discipline extends Model {

	protected $table = 'etbs_discipline';
	protected $primaryKey = 'id_disci';
	protected $guarded = array('*');
	public $timestamps = true;


	public function ecole(){return $this->belongsTo('App\Models\Ecole','ecole_id','id_eco');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListDiscipline(Request $req){

		$query = Discipline::with(['ecole','users_g'])->orderBy('created_at','desc');

		$ecole_idv = $req->get('ecole_id');
		if(isset($ecole_idv)){
			if($ecole_idv != null && $ecole_idv != '' && $ecole_idv != '-1'){
				Session()->put('etablis_idSess', intval($ecole_idv));
			}
			$query->where('ecole_id',$req->get('ecole_id'));
		}else{
			$query->where('ecole_id',session('etablis_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){					
				$query->where('code_disci','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('libelle_disci','like','%'.strtoupper(trim($recherche).'%'));
				
				$query->orWhereHas('ecole', function ($q) use ($recherche) {
					$q->where('nom_eco', 'like', '%'.strtoupper(trim($recherche).'%'));
					$q->orwhere('sigle_eco', 'like', '%'.strtoupper(trim($recherche).'%'));
				});
			});			//Recherche avancee sur ecole

		}
		return $query;
	}

	public static function sltListDiscipline(){

		$query = self::where('ecole_id',session('etablis_idSess'))
						->pluck('libelle_disci','id_disci');
		return $query;

	}

}


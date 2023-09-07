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

class Promotion extends Model {

	protected $table = 'etbs_promotion';
	protected $primaryKey = 'id_pro';
	protected $guarded = array('*');
	public $timestamps = true;


	public function classe(){return $this->belongsTo('App\Models\Classe','class_id','id_clas');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListPromotion(Request $req){

		$query = Promotion::with(['classe','users_g'])->orderBy('created_at','desc');

		$class_idv = $req->get('class_id');
		if(isset($class_idv)){
			if($class_idv != null && $class_idv != '' && $class_idv != '-1'){
				Session()->put('class_idSess', intval($class_idv));
			}
			$query->where('class_id',$req->get('class_id'));
		}else{
			// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
			//Session()->put('class_idSess', '')
			$query->where('class_id',session('class_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){					
				$query->orwhere('libelle_pro','like','%'.strtoupper(trim($recherche).'%'));
			});			//Recherche avancee sur classe
			$query->orWhereHas('classe', function ($q) use ($recherche) {
				$q->where('libelle_clas', 'like', '%'.strtoupper(trim($recherche).'%'));
			});
		}
		return $query;
	}

	public static function sltListPromotion(){
		$query = self::with(['classe','classe.anneesco']);
		
		$sessionEcole = session('etablis_idSess');
		$query = $query->WhereHas('classe.anneesco', function ($q) use ($sessionEcole) {
			$q->where('etablis_id', $sessionEcole);
		})->pluck('libelle_pro','id_pro');
		return $query;
	}

}


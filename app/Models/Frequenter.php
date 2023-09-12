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

class Frequenter extends Model {

	protected $table = 'etbs_frequenter';
	protected $primaryKey = 'id_freq';
	protected $guarded = array('*');
	public $timestamps = true;
	protected $fillable = [
		
		'eleve_id',
        'promotion_id',
	    ];


	public function eleve(){return $this->belongsTo('App\Models\Eleve','eleve_id','id_el');}

	public function promotion(){return $this->belongsTo('App\Models\Promotion','promotion_id','id_pro');}

	public static function getListEleveFrequente(Request $req){

		$query = Frequenter::with(['eleve','promotion'])->orderBy('created_at','desc');

		// $eleve_idv = $req->get('eleve_id');
		// if(isset($eleve_idv)){
		// 	if($eleve_idv != null && $eleve_idv != '' && $eleve_idv != '-1'){
		// 		Session()->put('eleve_idSess', intval($eleve_idv));
		// 	}
		// 	$query->where('eleve_id',$req->get('eleve_id'));
		// }else{
		// 	// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
		// 	//Session()->put('eleve_idSess', '')
		// 	$query->where('eleve_id',session('eleve_idSess'));
		// }

		$promotion_idv = $req->get('promotion_id');
		if(isset($promotion_idv)){
			if($promotion_idv != null && $promotion_idv != '' && $promotion_idv != '-1'){
				Session()->put('promotion_idSess', intval($promotion_idv));
			}
			$query->where('promotion_id',$req->get('promotion_id'));
		}else{
			// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
			//Session()->put('promotion_idSess', '')
			$query->where('promotion_id',session('promotion_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) Use ($recherche){
				$query->where('eleve_id','like','%'.strtoupper(trim($recherche).'%'));
			});			
			//Recherche avancee sur eleve
			$query->orWhereHas('eleve', function ($q) use ($recherche) {
				$q->where('nom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
			});
			//Recherche avancee sur promotion
			$query->orWhereHas('promotion', function ($q) use ($recherche) {
				$q->where('libelle_pro', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

		}
		return $query;
	}

	public static function sltListFrequenter(){
		$query = self::all()->pluck('','id_freq');
		return $query;
	}

}


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

class Definipromotion extends Model {

	protected $table = 'etbs_defini_promotion';
	protected $primaryKey = 'id_def';
	protected $guarded = array('*');
	public $timestamps = true;
	protected $fillable = [
		'prof_id',
        'promo_id',
	 ];


	public function users_g(){return $this->belongsTo('App\Models\User','prof_id','id');}
	public function promotion(){return $this->belongsTo('App\Models\Promotion','promo_id','id_pro');}
	public static function getListDefinirPromotion(Request $req){

		$query = Definipromotion::with(['users_g','promotion'])->orderBy('created_at','desc');

		// $prof_idv = $req->get('prof_id');
		// if(isset($prof_idv)){
		// 	if($prof_idv != null && $prof_idv != '' && $prof_idv != '-1'){
		// 		Session()->put('prof_idSess', intval($prof_idv));
		// 	}
		// 	$query->where('prof_id',$req->get('prof_id'));
		// }else{
		// 	$query->where('prof_id',session('prof_idSess'));
		// }

		$recherche = $req->get('query');
		if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){					
					// $query->where('prof_id','like','%'.strtoupper(trim($recherche).'%'));
				});			//Recherche avancee sur users
			// $query->orWhereHas('users_g', function ($q) use ($recherche) {
			// 	$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
			// 	$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			// });

			//Recherche avancee sur promotion
			$query->orWhereHas('promotion', function ($q) use ($recherche) {
				$q->where('libelle_pro', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

		}
		return $query;
	}

	public static function sltListDefinipromotion(){
		$query = self::all()->pluck('','id_def');
		return $query;
	}

	public static function sltListPromotion(){
			
		$PromoOccup = Definipromotion::where('prof_id',Auth::id())
								->select('promo_id')->pluck('promo_id','promo_id')->toArray();

		$query = Promotion::with(['classe','classe.anneesco']);

		$sessionEcole = session('etablis_idSess');
		$query = $query->WhereHas('classe.anneesco', function ($q) use ($sessionEcole) {
			$q->where('etablis_id', $sessionEcole);
		})->whereNotIn('id_pro', $PromoOccup)
		->pluck('libelle_pro','id_pro');

		return $query;
	}

}


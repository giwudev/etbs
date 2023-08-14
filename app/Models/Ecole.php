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

class Ecole extends Model {

	protected $table = 'etbs_ecole';
	protected $primaryKey = 'id_eco';
	protected $guarded = array('*');
	public $timestamps = true;


	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListEcole(Request $req){

		$query = Ecole::with(['users_g'])->orderBy('created_at','desc');

		$recherche = $req->get('query');
		if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){					$query->orwhere('nom_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('sigle_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('adres_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('ville_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('CodePos_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('pays_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('tel_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('email_eco','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('directeur_eco','like','%'.strtoupper(trim($recherche).'%'));
				});			//Recherche avancee sur users
			$query->orWhereHas('users_g', function ($q) use ($recherche) {
				$q->where('name', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

		}
		return $query;
	}

	public static function sltListEcole(){
		$query = self::all()->pluck('nom_eco','id_eco');
		return $query;
	}

}


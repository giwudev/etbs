<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Emploitemp;
use App\Models\Frequenter;
use Auth;

class Appeler extends Model {
	protected $table;
    public function __construct() {
        parent::__construct();
        $this->table = 'etbs_appeler_' . session('etablis_idSess');
    }
	protected $primaryKey = 'id_appel';
	protected $guarded = array('*');
	public $timestamps = true;

	public function emploitemp(){return $this->belongsTo('App\Models\Emploitemp','emploi_id','id_empl');}

	public function eleve(){return $this->belongsTo('App\Models\Eleve','eleve_id','id_el');}

	public function users_g(){return $this->belongsTo('App\Models\User','init_id','id');}

	public static function getListAppel(Request $req){
		// $query = Appeler::with(['emploitemp','eleve','users_g']);
		$emploi_idv = $req->get('emploi_id');
		if(isset($emploi_idv)){
			if($emploi_idv != null && $emploi_idv != '' && $emploi_idv != '-1'){
				Session()->put('emploi_idSess', intval($emploi_idv));
			}
		}
		$date_presence = $req->get('date_presence');
		if(isset($date_presence)){
			Session()->put('date_presenceSess', $date_presence);
		}else{
			Session()->put('date_presenceSess', date('Y-m-d'));
		}
		//Récuperer la promotion suivant l'emploi du temps choisi 
		$promotion = Emploitemp::where('id_empl',session('emploi_idSess'))->first();
		$idPromo = '';
		if($promotion){
			$idPromo = $promotion->promotion_id;
		}
		$query = Frequenter::with(['eleve'])
							->where('promotion_id',$idPromo);
							// ->orderBy('nom_el','desc');

		$recherche = $req->get('query');
		if(isset($recherche)){
			// //Recherche avancee sur eleve
			$query->orWhereHas('eleve', function ($q) use ($recherche) {
				$q->where('nom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('prenom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
			});
		}
		return $query;
	}

	public static function CheckElevePresence($eleve){
		//Vérifier si la ligne existe dans Appeler

		$query = Appeler::with(['emploitemp','eleve'])
						->where('emploi_id', session('emploi_idSess'))
						->where('eleve_id', $eleve)
						->where('date_presence', session('date_presenceSess'))->first();
		if(!$query){ //Si la ligne n'existe pas créer
			$appel = new Appeler();
			$appel->emploi_id = session('emploi_idSess');
			$appel->eleve_id = $eleve;
			$appel->etat_appel = true;
			$appel->date_presence = session('date_presenceSess');
			$appel->init_id = Auth::id();
			$appel->save();

			$query = Appeler::with(['emploitemp','eleve'])
							->where('id_appel', $appel->id_appel)->first();
		}
		return $query;
	}

	public static function sltListAppeler(){
		$query = self::all()->pluck('etat_appel','id_appel');
		return $query;
        // session('etablis_idSess')
	}


        public static function getListAppelPDF(Request $req){
            $query = Appeler::with(['emploitemp', 'eleve', 'users_g']);
            $emploi_idv = $req->get('emploi_id');
            if(isset($emploi_idv)){
                if($emploi_idv != null && $emploi_idv != '' && $emploi_idv != '-1'){
                    Session()->put('emploi_idSess', intval($emploi_idv));
                }
                $query->where('emploi_id', $req->get('emploi_id'));
            } else {
                $query->where('emploi_id', session('emploi_idSess'));
            }

            $recherche = $req->get('query');
            if(isset($recherche)){
                $query->WhereHas('eleve', function ($q) use ($recherche) {
                    $q->where('nom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
                    $q->orWhere('prenom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
                });
            }

            return $query;
        }

		public static function nbre_heure_abs($eleve_id,$promotion_id){
			$trimSem = Trimsem::find(session('periode_id'));
			if($trimSem){
				$dateDebut 	= $trimSem->date_debut;
				$dateFin 	= $trimSem->date_fin;
			}else{
				$dateDebut 	= '1970-01-01';
				$dateFin 	= '1970-01-01';
			}
			$allApp = Appeler::where('eleve_id',$eleve_id)
								->where('date_presence','>=',$dateDebut)
								->where('date_presence','<=',$dateFin)
								->where('etat_appel',false)
								->select('emploi_id')
								->get()
					->toArray();
				$emploiTempTotal = 0; 
				foreach ($allApp as $app) {
					$emploi_id = $app['emploi_id'];
					$emploiTemp = Emploitemp::where('promotion_id', $promotion_id)->where('id_empl', $emploi_id)->sum('nbreheure');
					$emploiTempTotal += $emploiTemp;
				}
				return $emploiTempTotal;
		}
}


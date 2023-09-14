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
use Carbon\Carbon;


class Emploitemp extends Model {

	protected $table = 'etbs_emploi_temp';
	protected $primaryKey = 'id_empl';
	protected $guarded = array('*');
	public $timestamps = true;


	
	public function discipline(){return $this->belongsTo('App\Models\Discipline','discipline_id','id_disci');}

	public function promotion(){return $this->belongsTo('App\Models\Promotion','promotion_id','id_pro');}

	public function anneesco(){return $this->belongsTo('App\Models\Anneesco','annee_id','id_annee');}

	public function users_g(){return $this->belongsTo('App\Models\User','prof_id','id');}


	public static function DifferenceTime($heureD, $HeureF) {	

		$heureDebut = Carbon::parse($heureD); // Heure de début au format "HH:MM:SS"
        $heureFin = Carbon::parse($HeureF);  // Heure de fin au format "HH:MM:SS"
        // Calculer la différence en minutes
        $differenceEnMinutes = $heureFin->diffInMinutes($heureDebut);
        // Convertir la différence en heures décimales
		$dif = $differenceEnMinutes / 60;
		return $dif;
    }

	public static function getListEmploieTemps(Request $req){

		$query = Emploitemp::with(['discipline','promotion','anneesco','users_g','users_g'])->orderBy('created_at','desc');

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

		$annee_idv = $req->get('annee_id');
		if(isset($annee_idv)){
			if($annee_idv != null && $annee_idv != '' && $annee_idv != '-1'){
				Session()->put('annee_idSess', intval($annee_idv));
			}
			$query->where('annee_id',$req->get('annee_id'));
		}else{
			// User::whereId(Auth::id())->first()->id); -- Peux etre ajouter si cest la table user
			//Session()->put('annee_idSess', '')
			$query->where('annee_id',session('annee_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){					$query->where('heure_debut','like','%'.strtoupper(trim($recherche).'%'));
					$query->orwhere('heure_fin','like','%'.strtoupper(trim($recherche).'%'));
				});			//Recherche avancee sur discipline
			$query->orWhereHas('discipline', function ($q) use ($recherche) {
				$q->where('code_disci', 'like', '%'.strtoupper(trim($recherche).'%'));
				$q->orwhere('libelle_disci', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

			//Recherche avancee sur promotion
			$query->orWhereHas('promotion', function ($q) use ($recherche) {
				$q->where('libelle_pro', 'like', '%'.strtoupper(trim($recherche).'%'));
			});

			//Recherche avancee sur anneesco
			$query->orWhereHas('anneesco', function ($q) use ($recherche) {
				$q->where('statut_annee', 'like', '%'.strtoupper(trim($recherche).'%'));
			});


		}
		return $query;
	}

	public static function sltListAppel(){

		$etablis_idSession = session('etablis_idSess');
		$query = self::with(['discipline', 'promotion', 'anneesco'])
			->whereHas('anneesco', function ($query) use ($etablis_idSession) { $query->where('etablis_id', $etablis_idSession);})->get()
			->map(function ($item) {
				$jour_semaine = trans('entite.semaine')[$item->jour_semaine];
				$address['id_empl']         = $item->id_empl;
				$address['vale'] = $jour_semaine . ' ' .substr($item->heure_debut,0,5 ). '-' .substr($item->heure_fin,0,5 ) . ' : ' .$item->discipline->code_disci . ' ' .$item->promotion->libelle_pro;
				return $address;
			})->pluck('vale','id_empl');
		return $query;
	}

    public static function sltListEmploitemp(){
        $query = self::all()->pluck('heure_debut','id_empl');
        return $query;
    }


}


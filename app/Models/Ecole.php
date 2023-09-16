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
use Illuminate\Support\Facades\DB;

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
				$query->where(function ($query) Use ($recherche){
                    $query->orwhere('nom_eco','like','%'.strtoupper(trim($recherche).'%'));
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

	
    public function createAppelerTable(){
		$table_name = 'etbs_appeler_' . $this->id_eco;
        DB::statement("DROP TABLE IF EXISTS `$table_name`;");
        DB::statement("CREATE TABLE IF NOT EXISTS `$table_name` (
            `id_appel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `emploi_id` bigint(20) UNSIGNED NOT NULL,
            `eleve_id` bigint(20) NOT NULL,
            `etat_appel` tinyint(1) NOT NULL DEFAULT '0',
            `date_presence` date DEFAULT NULL,
            `justifier` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `motif_just` longtext COLLATE utf8mb4_unicode_ci,
            `fichier_justif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `init_id` bigint(20) UNSIGNED NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id_appel`),
            KEY `etbs_appeler_emploi_id_foreign` (`emploi_id`),
            KEY `etbs_appeler_eleve_id_foreign` (`eleve_id`),
            KEY `etbs_appeler_init_id_foreign` (`init_id`)
        ) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

}


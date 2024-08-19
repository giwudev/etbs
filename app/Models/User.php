<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use App\Models\Userdirec;
use DB,Auth;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'etbs_users';
    
    protected $guarded=[];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Models\GiwuRole','id_role','id_role');
    }

    public function ecole(){
        return $this->belongsTo('App\Models\Ecole','etablis_id','id_eco');
    }
    
	public static function getListeUsers(Request $req){
		$query = self::with(['role'])->orderBy('name','asc');
        $query->WhereHas('role', function ($q) { $q->where('id_role', '<>', '1');});
        $etablis_idv = $req->get('etablis_id');
		if(isset($etablis_idv)){
			if($etablis_idv != null && $etablis_idv != '' && $etablis_idv != '-1'){
				Session()->put('etablis_idSess', intval($etablis_idv));
			}
			$query->where('etablis_id',$req->get('etablis_id'));
		}else{
			$query->where('etablis_id',session('etablis_idSess'));
		}

		$recherche = $req->get('query');
		if(isset($recherche)){
			$query->where(function ($query) use ($recherche){
				$query->orwhere('name','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('prenom','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('email','like','%'.strtoupper(trim($recherche).'%'));
				$query->orwhere('tel_user','like','%'.strtoupper(trim($recherche).'%'));
			});
		}
        
		return $query;
	}
	public static function sltListUser(){
		// $query = self::all()->pluck('name','id');
        $query =  self::select(DB::raw("CONCAT(name,' ',prenom) AS nomprenom"),'etbs_users.id')
                            ->whereNotIn('etbs_users.id',[1])
                            ->where('etbs_users.etablis_id',session('etablis_idSess'))
                            ->distinct()->get()->pluck('nomprenom','id');
		return $query;
	}
	public static function getListeProf(){
		// $query = self::all()->pluck('name','id');
        $query =  self::select(DB::raw("CONCAT(name,' ',prenom) AS nomprenom"),'etbs_users.id')
                            ->whereNotIn('etbs_users.id',[1])
                            ->where('etbs_users.etablis_id',session('etablis_idSess'))
                            ->where('etbs_users.id_role',16) //Professeur
                            ->distinct()->get()->pluck('nomprenom','id');
		return $query;
	}

	public static function sltListProf(){
        $query =  self::select(DB::raw("CONCAT(name,' ',prenom) AS nomprenom"),'etbs_users.id')
                                ->whereNotIn('etbs_users.id',[1])
                                ->where('etbs_users.etablis_id',session('etablis_idSess'))
                                ->where('etbs_users.id_role',16) //Role du prof
                                ->distinct()->get()->pluck('nomprenom','id');
		return $query;
	}
    
    public static function EtatUser($id){
        if($id == "1"){
            return "Activé";
        }else{
            return "Désactivé";
        }
    }
 
}

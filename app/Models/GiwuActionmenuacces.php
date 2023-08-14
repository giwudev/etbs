<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GiwuActionmenuacces extends Model {

	protected $table = 'etbs_action_menu_acces';
	protected $primaryKey = 'id_actionmenu';
	protected $guarded = array('*');
	public $timestamps = true;


	
    public static function getCheckActionAccesMenu($id_role,$id_menu,$id_action){
        
        return self::where('role_id',$id_role)
									->where('id_menu',$id_menu)
									->where('action_id',$id_action)
									->where('statut_action','1')
									->count();  
	}
	
    public static function getActionParRole($id_role){
		
		return self::join('etbs_action_acces','etbs_action_acces.id_action','etbs_action_menu_acces.action_id')
									->where('role_id',$id_role)
									->where('statut_action','1')
									->pluck('dev_action')->toArray();  
	}
	
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GiwuActionacces extends Model {

	protected $table = 'etbs_action_acces';
	protected $primaryKey = 'id_action';
	protected $guarded = array('*');
	public $timestamps = true;

}

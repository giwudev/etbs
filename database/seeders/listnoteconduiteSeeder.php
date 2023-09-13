<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class listnoteconduiteSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM etbs_menu WHERE architecture = '/cons'");

		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Note de conduite','titre_page'=>'Note de conduite',
			'controler'=>'listnoteconduiteController','route'=>'listnoteconduite',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/cons/listnoteconduite','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter listnoteconduite','dev_action'=>'exporter_listnoteconduite',],
		]);

		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};

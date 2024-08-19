<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PaiementprofSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM etbs_menu WHERE architecture = '/paie'");

		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Paiementprof','titre_page'=>'Paiementprof',
			'controler'=>'PaiementprofController','route'=>'paiementprof',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/paie/paiementprof','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter paiementprof','dev_action'=>'add_paiementprof',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier paiementprof','dev_action'=>'update_paiementprof',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer paiementprof','dev_action'=>'delete_paiementprof',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter paiementprof','dev_action'=>'exporter_paiementprof',],
		]);

		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		//Create
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Ajouter une paie','titre_page'=>'Ajout de Paiementprof',
			'controler'=>'PaiementprofController','route'=>'paiementprof/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/paie/paiementprof/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Modifier une paie','titre_page'=>'Modification de Paiementprof',
			'controler'=>'PaiementprofController','route'=>'paiementprof/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/paie/paiementprof/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};

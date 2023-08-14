<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class EcoleSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM etbs_menu WHERE architecture = '/param'");

		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Ecole','titre_page'=>'Ecole',
			'controler'=>'EcoleController','route'=>'ecole',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/ecole','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter ecole','dev_action'=>'add_ecole',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier ecole','dev_action'=>'update_ecole',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer ecole','dev_action'=>'delete_ecole',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter ecole','dev_action'=>'exporter_ecole',],
		]);

		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		//Create
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Ajouter une ecole','titre_page'=>'Ajout de Ecole',
			'controler'=>'EcoleController','route'=>'ecole/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/ecole/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Modifier une ecole','titre_page'=>'Modification de Ecole',
			'controler'=>'EcoleController','route'=>'ecole/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/ecole/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class EmploitempSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM etbs_menu WHERE architecture = '/param'");

		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Emploitemp','titre_page'=>'Emploitemp',
			'controler'=>'EmploitempController','route'=>'emploitemp',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/emploitemp','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter emploitemp','dev_action'=>'add_emploitemp',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier emploitemp','dev_action'=>'update_emploitemp',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer emploitemp','dev_action'=>'delete_emploitemp',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter emploitemp','dev_action'=>'exporter_emploitemp',],
		]);

		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		//Create
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Ajouter','titre_page'=>'Ajout de Emploitemp',
			'controler'=>'EmploitempController','route'=>'emploitemp/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/emploitemp/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Modifier','titre_page'=>'Modification de Emploitemp',
			'controler'=>'EmploitempController','route'=>'emploitemp/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/emploitemp/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};

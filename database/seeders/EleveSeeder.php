<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class EleveSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM etbs_menu WHERE architecture = '/param'");

		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Eleve','titre_page'=>'Eleve',
			'controler'=>'EleveController','route'=>'eleve',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/eleve','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter eleve','dev_action'=>'add_eleve',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier eleve','dev_action'=>'update_eleve',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer eleve','dev_action'=>'delete_eleve',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter eleve','dev_action'=>'exporter_eleve',],
		]);

		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		//Create
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Ajouter','titre_page'=>'Ajout de Eleve',
			'controler'=>'EleveController','route'=>'eleve/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/eleve/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Modifier','titre_page'=>'Modification de Eleve',
			'controler'=>'EleveController','route'=>'eleve/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/eleve/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};

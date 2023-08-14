<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TrimsemSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM etbs_menu WHERE architecture = '/param'");

		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Trimsem','titre_page'=>'Trimsem',
			'controler'=>'TrimsemController','route'=>'trimsem',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/trimsem','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter trimsem','dev_action'=>'add_trimsem',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier trimsem','dev_action'=>'update_trimsem',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer trimsem','dev_action'=>'delete_trimsem',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter trimsem','dev_action'=>'exporter_trimsem',],
		]);

		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		//Create
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Ajouter une periode','titre_page'=>'Ajout de Trimsem',
			'controler'=>'TrimsemController','route'=>'trimsem/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/trimsem/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('etbs_menu')->insert([
			['libelle_menu'=>'Modifier une periode','titre_page'=>'Modification de Trimsem',
			'controler'=>'TrimsemController','route'=>'trimsem/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/trimsem/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM etbs_menu');
		DB::table('etbs_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};

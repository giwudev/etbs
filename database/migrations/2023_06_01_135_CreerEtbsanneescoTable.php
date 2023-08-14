<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbsanneescoTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_annee_sco', function (Blueprint $table) { 

			$table->bigIncrements('id_annee')->unsigned();
			$table->bigInteger('annee_debut');
			$table->bigInteger('annee_fin');
			$table->text('statut_annee');
			$table->bigInteger('init_id')->unsigned();
			$table->bigInteger('etablis_id')->unsigned();
			$table->foreign('init_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('etablis_id')->references('id_eco')->on('etbs_ecole')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('etbs_annee_sco');

	}
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbseleveTable extends Migration {
	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/
	public function up() {

		Schema::create('etbs_eleve', function (Blueprint $table) { 

			$table->bigIncrements('id_el')->unsigned();
			$table->text('nom_el');
			$table->text('prenom_el');
			$table->text('matricule_el');
			$table->date('date_nais_el')->nullable();
			$table->text('sexe_el');
			$table->string('photo_el')->nullable();
			$table->text('tuteur_el')->nullable();
			$table->text('email_el')->nullable();
			$table->text('tel_el')->nullable();
			$table->bigInteger('ecole_id')->unsigned();
			$table->bigInteger('init_id')->unsigned();
			$table->foreign('ecole_id')->references('id_eco')->on('etbs_ecole')->onDelete('set null');
			$table->foreign('init_id')->references('id')->on('users')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('etbs_eleve');

	}
}

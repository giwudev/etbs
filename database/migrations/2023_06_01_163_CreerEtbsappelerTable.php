<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbsappelerTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_appeler', function (Blueprint $table) {

			$table->bigIncrements('id_appel')->unsigned();
			$table->bigInteger('emploi_id')->unsigned();
			$table->bigInteger('eleve_id');
			$table->boolean('etat_appel', 1)->default('0');
			$table->bigInteger('init_id')->unsigned();
			$table->foreign('emploi_id')->references('id_empl')->on('etbs_emploi_temp')->onDelete('set null');
			$table->foreign('eleve_id')->references('id_el')->on('etbs_eleve')->onDelete('set null');
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

		Schema::dropIfExists('etbs_appeler');

	}
}

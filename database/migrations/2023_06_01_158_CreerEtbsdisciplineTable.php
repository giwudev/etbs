<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbsdisciplineTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_discipline', function (Blueprint $table) { 

			$table->bigIncrements('id_disci')->unsigned();
			$table->text('code_disci');
			$table->text('libelle_disci');
			$table->bigInteger('init_id')->unsigned();
			$table->bigInteger('ecole_id')->unsigned();
			$table->foreign('init_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('ecole_id')->references('id_eco')->on('etbs_ecole')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('etbs_discipline');

	}
}

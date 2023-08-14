<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbstrimsemTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_trim_sem', function (Blueprint $table) { 

			$table->bigIncrements('id_trimSem')->unsigned();
			$table->text('libelle_trimSem');
			$table->text('statut_trimSem');
			$table->bigInteger('annee_id')->unsigned();
			$table->bigInteger('init_id')->unsigned();
			$table->foreign('annee_id')->references('id_annee')->on('etbs_annee_sco')->onDelete('set null');
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

		Schema::dropIfExists('etbs_trim_sem');

	}
}

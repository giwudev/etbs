<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbsemploitempTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_emploi_temp', function (Blueprint $table) {

			$table->bigIncrements('id_empl')->unsigned();
			$table->time('heure_debut');
			$table->time('heure_fin');
			$table->bigInteger('jour_semaine');
			$table->bigInteger('discipline_id')->unsigned();
			$table->bigInteger('promotion_id')->unsigned();
			$table->bigInteger('init_id')->unsigned();
			$table->bigInteger('annee_id')->unsigned();
			$table->bigInteger('prof_id')->unsigned();
			$table->foreign('discipline_id')->references('id_disci')->on('etbs_discipline')->onDelete('set null');
			$table->foreign('promotion_id')->references('id_pro')->on('etbs_promotion')->onDelete('set null');
			$table->foreign('init_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('annee_id')->references('id_annee')->on('etbs_annee_sco')->onDelete('set null');
			$table->foreign('prof_id')->references('id')->on('users')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('etbs_emploi_temp');

	}
}

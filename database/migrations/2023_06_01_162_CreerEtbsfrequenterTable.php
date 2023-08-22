<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbsfrequenterTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_frequenter', function (Blueprint $table) { 

			$table->bigIncrements('id_freq')->unsigned();
			$table->bigInteger('eleve_id')->unsigned();
			$table->bigInteger('promotion_id')->unsigned();
			$table->foreign('eleve_id')->references('id_el')->on('etbs_eleve')->onDelete('set null');
			$table->foreign('promotion_id')->references('id_pro')->on('etbs_promotion')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('etbs_frequenter');

	}
}

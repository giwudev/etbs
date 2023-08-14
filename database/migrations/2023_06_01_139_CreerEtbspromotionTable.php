<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbspromotionTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_promotion', function (Blueprint $table) { 

			$table->bigIncrements('id_pro')->unsigned();
			$table->text('libelle_pro');
			$table->bigInteger('class_id')->unsigned();
			$table->bigInteger('init_id')->unsigned();
			$table->foreign('class_id')->references('id_clas')->on('etbs_classe')->onDelete('set null');
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

		Schema::dropIfExists('etbs_promotion');

	}
}

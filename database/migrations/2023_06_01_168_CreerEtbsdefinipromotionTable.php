<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbsdefinipromotionTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_defini_promotion', function (Blueprint $table) { 

			$table->bigIncrements('id_def')->unsigned();
			$table->bigInteger('prof_id');
			$table->bigInteger('promo_id');
			$table->foreign('prof_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('promo_id')->references('id_pro')->on('etbs_promotion')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('etbs_defini_promotion');

	}
}

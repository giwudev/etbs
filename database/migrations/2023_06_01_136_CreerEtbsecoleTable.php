<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbsecoleTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_ecole', function (Blueprint $table) { 

			$table->bigIncrements('id_eco')->unsigned();
			$table->text('nom_eco');
			$table->text('sigle_eco');
			$table->text('adres_eco')->nullable();
			$table->text('ville_eco');
			$table->text('CodePos_eco')->nullable();
			$table->text('pays_eco');
			$table->text('tel_eco');
			$table->text('email_eco');
			$table->text('directeur_eco');
			$table->text('niveau_educ_eco');
			$table->bigInteger('init_id')->unsigned();
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

		Schema::dropIfExists('etbs_ecole');

	}
}

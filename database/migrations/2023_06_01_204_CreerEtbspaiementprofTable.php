<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbspaiementprofTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_paiement_prof', function (Blueprint $table) { 

			$table->bigIncrements('id_paie')->unsigned();
			$table->bigInteger('id_prof')->unsigned();
			$table->bigInteger('montant_total');
			$table->boolean('payer_bool', 1)->default('0');
			$table->bigInteger('init_id')->unsigned();
			$table->date('datedebut');
			$table->date('datefin');
			$table->bigInteger('etablis_id');
			$table->foreign('id_prof')->references('id')->on('users')->onDelete('set null');
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

		Schema::dropIfExists('etbs_paiement_prof');

	}
}

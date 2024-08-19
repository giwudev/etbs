<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerEtbspayerprofTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('etbs_payer_prof', function (Blueprint $table) { 

			$table->bigIncrements('id_payer')->unsigned();
			$table->bigInteger('paiement_id')->unsigned();
			$table->text('description');
			$table->bigInteger('PrixUnitaire');
			$table->bigInteger('qte');
			$table->bigInteger('montant');
			$table->foreign('paiement_id')->references('id_paie')->on('etbs_paiement_prof')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('etbs_payer_prof');

	}
}

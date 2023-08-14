<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EcoleExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsEcole');
	} 

	public function  headings():array{
		return [
			trans('data.nom_eco'),
			trans('data.sigle_eco'),
			trans('data.adres_eco'),
			trans('data.ville_eco'),
			trans('data.CodePos_eco'),
			trans('data.pays_eco'),
			trans('data.tel_eco'),
			trans('data.email_eco'),
			trans('data.directeur_eco'),
			trans('data.niveau_educ_eco'),
			trans('data.init_id'),
		];
	}
}

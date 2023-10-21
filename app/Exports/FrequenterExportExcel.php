<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FrequenterExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsFrequenter');
	} 

	public function  headings():array{
		return [
			trans('data.matricule_el'),
			trans('data.nom_el'),
			trans('data.prenom_el'),
			trans('data.date_nais_el'),
			trans('data.sexe_el'),
			trans('data.tuteur_el'),
			trans('data.email_el'),
			trans('data.tel_el'),
		];
	}
}

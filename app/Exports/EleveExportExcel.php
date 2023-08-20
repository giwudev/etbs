<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EleveExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsEleve');
	} 

	public function  headings():array{
		return [
			trans('data.id_el'),
			trans('data.nom_el'),
			trans('data.prenom_el'),
			trans('data.matricule_el'),
			trans('data.date_nais_el'),
			trans('data.sexe_el'),
			trans('data.photo_el'),
			trans('data.tuteur_el'),
			trans('data.email_el'),
			trans('data.tel_el'),
			trans('data.ecole_id'),
			trans('data.init_id'),
		];
	}
}

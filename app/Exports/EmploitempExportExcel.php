<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmploitempExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsEmploitemp');
	} 

	public function  headings():array{
		return [
			trans('data.id_empl'),
			trans('data.heure_debut'),
			trans('data.heure_fin'),
			trans('data.jour_semaine'),
			trans('data.discipline_id'),
			trans('data.promotion_id'),
			trans('data.annee_id'),
			trans('data.prof_id'),
			trans('data.init_id'),
		];
	}
}

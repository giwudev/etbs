<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnneescoExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsAnneesco');
	} 

	public function  headings():array{
		return [
			trans('data.id_annee'),
			trans('data.annee_debut'),
			trans('data.annee_fin'),
			trans('data.statut_annee'),
			trans('data.init_id'),
			trans('data.etablis_id'),
		];
	}
}

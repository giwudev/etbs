<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AppelerExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsAppeler');
	} 

	public function  headings():array{
		return [
			trans('data.id_appel'),
			trans('data.emploi_id'),
			trans('data.eleve_id'),
			trans('data.init_id'),
			trans('data.etat_appel'),
		];
	}
}

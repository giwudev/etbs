<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TrimsemExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsTrimsem');
	} 

	public function  headings():array{
		return [
			trans('data.libelle_trimSem'),
			trans('data.statut_trimSem'),
			trans('data.annee_id'),
			trans('data.init_id'),
		];
	}
}

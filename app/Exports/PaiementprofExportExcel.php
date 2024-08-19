<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaiementprofExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsPaiementprof');
	} 

	public function  headings():array{
		return [
			trans('data.id_paie'),
			trans('data.id_prof'),
			trans('data.datedebut'),
			trans('data.datefin'),
			trans('data.montant_total'),
			trans('data.payer_bool'),
			trans('data.init_id'),
		];
	}
}

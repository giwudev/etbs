<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DisciplineExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlsDiscipline');
	} 

	public function  headings():array{
		return [
			trans('data.id_disci'),
			trans('data.code_disci'),
			trans('data.libelle_disci'),
			trans('data.ecole_id'),
			trans('data.init_id'),
		];
	}
}

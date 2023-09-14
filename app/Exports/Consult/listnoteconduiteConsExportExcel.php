<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Exports\Consult;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class listnoteconduiteConsExportExcel implements FromCollection, WithHeadings,ShouldAutoSize {
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function collection(){
		return session('xlslistnoteconduite');
	} 

	public function  headings():array{
		return [
			trans('data.id_freq'),
			trans('data.eleve_id'),
			trans('data.promotion_id'),
			trans('data.created_at'),
		];
	}
}

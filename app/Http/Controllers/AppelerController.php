<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu
	*/
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use Auth;
use App\Models\Appeler;
use App\Models\Ecole;
use App\Models\Emploitemp;
use App\Models\Eleve;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppelerExportExcel;
use PDF;


class AppelerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/appel/appeler");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Appeler::getListAppel($req)->paginate(20);
		$giwu['listemploi_id'] = Emploitemp::sltListAppel();
		$giwu['listeleve_id'] = Eleve::sltListEleve();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		if($req->ajax()) {
			return view('appeler.index-search')->with($giwu);
		}
		return view('appeler.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	public function exporterExcel(Request $req) {
		$Resultat = Appeler::getListAppel($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_appel'] = $giw->id_appel;
				$tablgiwu[$i]['emploitemp'] = isset($giw->emploitemp) ? $giw->emploitemp->heure_debut : trans('data.not_found');
				$tablgiwu[$i]['eleve'] = isset($giw->eleve) ? $giw->eleve->nom_el : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$tablgiwu[$i]['etat_appel'] = $giw->etat_appel;
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsAppeler', $Resultat);
		return Excel::download(new AppelerExportExcel, 'AppelerExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Appeler::getListAppel($req)->get();
		$pdf = PDF::loadView('appeler.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('appeler-'.date('Ymdhis').'.pdf');
	}




}


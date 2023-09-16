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
use App\Models\Ecole;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EcoleExportExcel;
use PDF;


class EcoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/ecole");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Ecole::getListEcole($req)->paginate(20);
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('ecole.index-search')->with($giwu);
		}
		return view('ecole.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/ecole/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listinit_id'] = User::sltListUser();
		return view('ecole.create')->with($giwu);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
		try {
			$datas = $request->all();
			unset($datas['_token']);
			$newAdd = new Ecole();
			$newAdd->nom_eco = $datas['nom_eco'];
			$newAdd->sigle_eco = $datas['sigle_eco'];
			$newAdd->adres_eco = $datas['adres_eco'];
			$newAdd->ville_eco = $datas['ville_eco'];
			$newAdd->CodePos_eco = $datas['CodePos_eco'];
			$newAdd->pays_eco = $datas['pays_eco'];
			$newAdd->tel_eco = $datas['tel_eco'];
			$newAdd->email_eco = $datas['email_eco'];
			$newAdd->directeur_eco = $datas['directeur_eco'];
			$newAdd->niveau_educ_eco = $datas['niveau_educ_eco'];
			$newAdd->init_id = Auth::id();
			$newAdd->save(); 
			$newAdd->createAppelerTable();
			GiwuSaveTrace::enregistre('Ajout du nouveau ecole : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
			return Redirect::back()->with('success',trans('data.infos_add'));
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}

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
		$array = GiwuService::Path_Image_menu("/param/ecole/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Ecole::where('id_eco',$id)->first();
		return view('ecole.edit')->with($giwu);
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
		try {
			$dataInitiale = Ecole::where('id_eco',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Ecole::where('id_eco',$id)->first();

			$newUpd->nom_eco = $datas['nom_eco'];
			$newUpd->sigle_eco = $datas['sigle_eco'];
			$newUpd->adres_eco = $datas['adres_eco'];
			$newUpd->ville_eco = $datas['ville_eco'];
			$newUpd->CodePos_eco = $datas['CodePos_eco'];
			$newUpd->pays_eco = $datas['pays_eco'];
			$newUpd->tel_eco = $datas['tel_eco'];
			$newUpd->email_eco = $datas['email_eco'];
			$newUpd->directeur_eco = $datas['directeur_eco'];
			$newUpd->niveau_educ_eco = $datas['niveau_educ_eco'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification ecole : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('ecole.index')->with('success',trans('data.infos_update'));
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function AffichePopDelete($id) {
		$giwu['item'] = Ecole::where('id_eco',$id)->first();
		return view('ecole.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Ecole::find($id)->toArray();
			$affectedRows = Ecole::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du ecole : ".$dataSupp);
				return redirect()->route('ecole.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Ecole::getListEcole($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['nom_eco'] = $giw->nom_eco;
				$tablgiwu[$i]['sigle_eco'] = $giw->sigle_eco;
				$tablgiwu[$i]['adres_eco'] = $giw->adres_eco;
				$tablgiwu[$i]['ville_eco'] = $giw->ville_eco;
				$tablgiwu[$i]['CodePos_eco'] = $giw->CodePos_eco;
				$tablgiwu[$i]['pays_eco'] = $giw->pays_eco;
				$tablgiwu[$i]['tel_eco'] = $giw->tel_eco;
				$tablgiwu[$i]['email_eco'] = $giw->email_eco;
				$tablgiwu[$i]['directeur_eco'] = $giw->directeur_eco;
				$tablgiwu[$i]['niveau_educ_eco'] = $giw->niveau_educ_eco;
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsEcole', $Resultat);
		return Excel::download(new EcoleExportExcel, 'EcoleExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Ecole::getListEcole($req)->get();
		$pdf = PDF::loadView('ecole.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('ecole-'.date('Ymdhis').'.pdf');
	}

	


}


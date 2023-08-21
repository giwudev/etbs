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
use App\Models\Discipline;
use App\Models\Ecole;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DisciplineExportExcel;
use PDF;


class DisciplineController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/discipline");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Discipline::getListDiscipline($req)->paginate(20);
		$giwu['listecole_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('discipline.index-search')->with($giwu);
		}
		return view('discipline.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/discipline/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listecole_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		return view('discipline.create')->with($giwu);
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
			$newAdd = new Discipline();
			$newAdd->code_disci = $datas['code_disci'];
			$newAdd->libelle_disci = $datas['libelle_disci'];
			$newAdd->ecole_id = $datas['ecole_id'];
			$newAdd->init_id = Auth::id();
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau discipline : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
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
		$array = GiwuService::Path_Image_menu("/param/discipline/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listecole_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Discipline::where('id_disci',$id)->first();
		return view('discipline.edit')->with($giwu);
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
			$dataInitiale = Discipline::where('id_disci',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Discipline::where('id_disci',$id)->first();

			$newUpd->code_disci = $datas['code_disci'];
			$newUpd->libelle_disci = $datas['libelle_disci'];
			$newUpd->ecole_id = $datas['ecole_id'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification discipline : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('discipline.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Discipline::where('id_disci',$id)->first();
		return view('discipline.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Discipline::find($id)->toArray();
			$affectedRows = Discipline::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du discipline : ".$dataSupp);
				return redirect()->route('discipline.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Discipline::getListDiscipline($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_disci'] = $giw->id_disci;
				$tablgiwu[$i]['code_disci'] = $giw->code_disci;
				$tablgiwu[$i]['libelle_disci'] = $giw->libelle_disci;
				$tablgiwu[$i]['ecole'] = isset($giw->ecole) ? $giw->ecole->nom_eco : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsDiscipline', $Resultat);
		return Excel::download(new DisciplineExportExcel, 'DisciplineExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Discipline::getListDiscipline($req)->get();
		$pdf = PDF::loadView('discipline.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('discipline-'.date('Ymdhis').'.pdf');
	}

	


}


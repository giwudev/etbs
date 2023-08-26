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
use App\Models\Frequenter;
use App\Models\Emploitemp;
use App\Models\Eleve;
use App\Models\Ecole;
use App\Models\Promotion;
use App\Models\Appeler;
use App\Models\Anneesco;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FrequenterExportExcel;
use PDF;


class FrequenterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/cons/frequenter");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Frequenter::getListEleveFrequente($req)->paginate(20);
		$giwu['listeleve_id'] = Eleve::sltListEleve();
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		$giwu['listannee_id'] = Anneesco::sltListAnneesco();
		if($req->ajax()) {
			return view('frequenter.index-search')->with($giwu);
		}
		return view('frequenter.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/cons/frequenter/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listeleve_id'] = Eleve::sltListEleve();
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
		return view('frequenter.create')->with($giwu);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		try{
			$datas = $request->all();
			unset($datas['_token']);

			//Important d'ajouter l'année
			$existingFrequenter = Frequenter::where('eleve_id', $datas['eleve_id'])->first();

			if ($existingFrequenter) {
				return Redirect::back()->withInput()->with('error', "Cet élève fréquente déjà une autre promotion.");
			}

			$newAdd = new Frequenter();
			$newAdd->eleve_id = $datas['eleve_id'];
			$newAdd->promotion_id = $datas['promotion_id'];
			$newAdd->save();
			//Charger les emploi du temps en fonction de la promotion choisie
			self::ChargerAppelEmploi($newAdd->promotion_id, $newAdd->eleve_id);
			GiwuSaveTrace::enregistre('Ajout du nouveau frequenter : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			return Redirect::back()->with('success', trans('data.infos_add'));
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
		}
	}
    public function ChargerAppelEmploi($idPromo, $idEleve){
		//Charger les emploi du temps en fonction de la promotion choisie
		$emploi = Emploitemp::where('promotion_id',$idPromo)->get();
		foreach ($emploi as $emp){
			$appel = new Appeler();
			$appel->emploi_id = $emp->id_empl;
			$appel->eleve_id = $idEleve;
			$appel->etat_appel = false;
			$appel->init_id = Auth::id();
			$appel->save();
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
		$array = GiwuService::Path_Image_menu("/cons/frequenter/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listeleve_id'] = Eleve::sltListEleve();
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
		$giwu['item'] = Frequenter::where('id_freq',$id)->first();
		return view('frequenter.edit')->with($giwu);
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
			$dataInitiale = Frequenter::where('id_freq',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Frequenter::where('id_freq',$id)->first();
            if ($datas['eleve_id'] != $newUpd->eleve_id){
				$emploi = Emploitemp::where('promotion_id',$newUpd->promotion_id)->get();
				foreach ($emploi as $emp){
					Appeler::where('eleve_id', $newUpd->eleve_id)
							->where('emploi_id', $emp->id_empl)->delete();
				}
            }
			$newUpd->eleve_id = $datas['eleve_id'];
			$newUpd->promotion_id = $datas['promotion_id'];
			$newUpd->save();
			//Charger les emploi du temps en fonction de la promotion choisie
			self::ChargerAppelEmploi($newUpd->promotion_id, $newUpd->eleve_id);

			GiwuSaveTrace::enregistre("Modification frequenter : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('frequenter.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Frequenter::where('id_freq',$id)->first();
		return view('frequenter.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Frequenter::find($id)->toArray();
			$affectedRows = Frequenter::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du frequenter : ".$dataSupp);
				return redirect()->route('frequenter.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Frequenter::getListEleveFrequente($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_freq'] = $giw->id_freq;
				$tablgiwu[$i]['eleve'] = isset($giw->eleve) ? $giw->eleve->nom_el : trans('data.not_found');
				$tablgiwu[$i]['promotion'] = isset($giw->promotion) ? $giw->promotion->libelle_pro : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsFrequenter', $Resultat);
		return Excel::download(new FrequenterExportExcel, 'FrequenterExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Frequenter::getListEleveFrequente($req)->get();
		$pdf = PDF::loadView('frequenter.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('frequenter-'.date('Ymdhis').'.pdf');
	}




}


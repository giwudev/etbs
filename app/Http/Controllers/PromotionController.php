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
use App\Models\Promotion;
use App\Models\Classe;
use App\Models\User;
use App\Models\Ecole;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PromotionExportExcel;
use PDF;


class PromotionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/promotion");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Promotion::getListPromotion($req)->paginate(20);
		$giwu['listclass_id'] = Classe::sltListClasse();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		if($req->ajax()) {
			return view('promotion.index-search')->with($giwu);
		}
		return view('promotion.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/promotion/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listclass_id'] = Classe::sltListClasse();
		$giwu['listinit_id'] = User::sltListUser();
		
		return view('promotion.create')->with($giwu);
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
			$newAdd = new Promotion();
			$newAdd->libelle_pro = $datas['libelle_pro'];
			$newAdd->class_id = $datas['class_id'];
			$newAdd->init_id = Auth::id();
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau promotion : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
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
		$array = GiwuService::Path_Image_menu("/param/promotion/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listclass_id'] = Classe::sltListClasse();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Promotion::where('id_pro',$id)->first();
		return view('promotion.edit')->with($giwu);
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
			$dataInitiale = Promotion::where('id_pro',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Promotion::where('id_pro',$id)->first();

			$newUpd->libelle_pro = $datas['libelle_pro'];
			$newUpd->class_id = $datas['class_id'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification promotion : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('promotion.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Promotion::where('id_pro',$id)->first();
		return view('promotion.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Promotion::find($id)->toArray();
			$affectedRows = Promotion::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du promotion : ".$dataSupp);
				return redirect()->route('promotion.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Promotion::getListPromotion($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['libelle_pro'] = $giw->libelle_pro;
				$tablgiwu[$i]['classe'] = isset($giw->classe) ? $giw->classe->libelle_clas : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsPromotion', $Resultat);
		return Excel::download(new PromotionExportExcel, 'PromotionExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Promotion::getListPromotion($req)->get();
		$pdf = PDF::loadView('promotion.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('promotion-'.date('Ymdhis').'.pdf');
	}

	


}


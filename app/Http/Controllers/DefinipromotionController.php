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
use App\Models\Definipromotion;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Ecole;
use App\Models\Anneesco;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DefinipromotionExportExcel;
use PDF;


class DefinipromotionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/definipromotion");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Definipromotion::getListDefinirPromotion($req)->paginate(20);
		$giwu['listprof_id'] = User::sltListUser();
		$giwu['listpromo_id'] = Definipromotion::sltListPromotion();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
		$giwu['listannee_id'] = Anneesco::sltListAnneesco();
		if($req->ajax()) {
			return view('definipromotion.index-search')->with($giwu);
		}
		return view('definipromotion.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/definipromotion/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listprof_id'] = User::sltListUser();
		$giwu['listpromo_id'] = Definipromotion::sltListPromotion();
		return view('definipromotion.create')->with($giwu);
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
			$newAdd = new Definipromotion();
			$newAdd->prof_id = Auth::id();
			$newAdd->promo_id = $datas['promo_id'];
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau definipromotion : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
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
		$array = GiwuService::Path_Image_menu("/param/definipromotion/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listprof_id'] = User::sltListUser();
		$giwu['listpromo_id'] = Definipromotion::sltListPromotion();
		$giwu['item'] = Definipromotion::where('id_def',$id)->first();
		return view('definipromotion.edit')->with($giwu);
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
			$dataInitiale = Definipromotion::where('id_def',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Definipromotion::where('id_def',$id)->first();

			$newUpd->promo_id = $datas['promo_id'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification definipromotion : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('definipromotion.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Definipromotion::where('id_def',$id)->first();
		return view('definipromotion.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Definipromotion::find($id)->toArray();
			$affectedRows = Definipromotion::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du definipromotion : ".$dataSupp);
				return redirect()->route('definipromotion.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Definipromotion::getListDefinirPromotion($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_def'] = $giw->id_def;
				$tablgiwu[$i]['prof_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$tablgiwu[$i]['promotion'] = isset($giw->promotion) ? $giw->promotion->libelle_pro : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsDefinipromotion', $Resultat);
		return Excel::download(new DefinipromotionExportExcel, 'DefinipromotionExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Definipromotion::getListDefinirPromotion($req)->get();
		$pdf = PDF::loadView('definipromotion.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('definipromotion-'.date('Ymdhis').'.pdf');
	}

	


}


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
use App\Models\Anneesco;
use App\Models\User;
use App\Models\Ecole;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnneescoExportExcel;
use PDF;


class AnneescoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/anneesco");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Anneesco::getListAnnee($req)->paginate(20);
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		if($req->ajax()) {
			return view('anneesco.index-search')->with($giwu);
		}
		return view('anneesco.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/anneesco/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		return view('anneesco.create')->with($giwu);
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
			//Interdir d'activer d'une année en cours
			$ann = Anneesco::where('etablis_id',$datas['etablis_id'])->where('statut_annee','a')->count();
			if($ann != 0 ){
				return Redirect::back()->withInput()->with('error','Une année est déjà encours impossible d\'ajouter une autre.');
			}
			unset($datas['_token']);
			$newAdd = new Anneesco();
			$newAdd->annee_debut = $datas['annee_debut'];
			$newAdd->annee_fin = $datas['annee_fin'];
			$newAdd->statut_annee = $datas['statut_annee'];
			$newAdd->init_id = Auth::id();
			$newAdd->etablis_id = $datas['etablis_id'];
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau anneesco : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
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
		$array = GiwuService::Path_Image_menu("/param/anneesco/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		$giwu['item'] = Anneesco::where('id_annee',$id)->first();
		return view('anneesco.edit')->with($giwu);
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
			$dataInitiale = Anneesco::where('id_annee',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			//Interdir d'activer plus d'une année en cours
			$ann = Anneesco::where('etablis_id',$datas['etablis_id'])->where('statut_annee','a')->first();
			if($ann && $ann->statut_annee != 'd' && $datas['statut_annee'] == 'a'){
				return Redirect::back()->withInput()->with('error','Impossible de modifier le statut cette information.');
			}
			if($ann && $ann->id_annee != $dataInitiale['id_annee'] && $datas['statut_annee'] == 'a'){
				return Redirect::back()->withInput()->with('error','Impossible de modifier le statut cette information.');
			}

			$newUpd=Anneesco::where('id_annee',$id)->first();

			$newUpd->annee_debut = $datas['annee_debut'];
			$newUpd->annee_fin = $datas['annee_fin'];
			$newUpd->statut_annee = $datas['statut_annee'];
			$newUpd->etablis_id = $datas['etablis_id'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification anneesco : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('anneesco.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Anneesco::where('id_annee',$id)->first();
		return view('anneesco.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Anneesco::find($id)->toArray();
			$affectedRows = Anneesco::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du anneesco : ".$dataSupp);
				return redirect()->route('anneesco.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Anneesco::getListAnnee($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_annee'] = $giw->id_annee;
				$tablgiwu[$i]['annee_debut'] = $giw->annee_debut;
				$tablgiwu[$i]['annee_fin'] = $giw->annee_fin;
				$tablgiwu[$i]['statut_annee'] = $giw->statut_annee;
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$tablgiwu[$i]['ecole'] = isset($giw->ecole) ? $giw->ecole->nom_eco : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsAnneesco', $Resultat);
		return Excel::download(new AnneescoExportExcel, 'AnneescoExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Anneesco::getListAnnee($req)->get();
		$pdf = PDF::loadView('anneesco.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('anneesco-'.date('Ymdhis').'.pdf');
	}

	


}


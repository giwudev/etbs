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
use App\Models\Eleve;
use App\Models\Ecole;
use App\Models\User;
use App\Utilities\FileStorage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EleveExportExcel;
use PDF;


class EleveController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/eleve");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Eleve::getListEleve($req)->paginate(20);
		$giwu['listecole_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		if($req->ajax()) {
			return view('eleve.index-search')->with($giwu);
		}
		return view('eleve.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/eleve/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listecole_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		return view('eleve.create')->with($giwu);
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
			//Condition sur Photo
			$datas['photo_el']="";
			$file1 = $request->file('photo_el');
			if($file1){
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'jpeg' && $extension != 'jpg' && $extension != 'png'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Photo) doit &ecirc;tre de type image (*.jpeg, *.jpg, *.png).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/docs/";
				$file1->move($pathName, $filename);
				$datas['photo_el']=$filename;
			}
			$newAdd = new Eleve();
			$newAdd->nom_el = $datas['nom_el'];
			$newAdd->prenom_el = $datas['prenom_el'];
			$newAdd->matricule_el = $datas['matricule_el'];
			$newAdd->date_nais_el = $datas['date_nais_el'];
			$newAdd->sexe_el = $datas['sexe_el'];
			$newAdd->photo_el = $datas['photo_el'];
			$newAdd->tuteur_el = $datas['tuteur_el'];
			$newAdd->email_el = $datas['email_el'];
			$newAdd->tel_el = $datas['tel_el'];
			$newAdd->ecole_id = $datas['ecole_id'];
			$newAdd->init_id = Auth::id();
			$newAdd->save(); 

			GiwuSaveTrace::enregistre('Ajout du nouveau eleve : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
			
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
		$array = GiwuService::Path_Image_menu("/param/eleve/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listecole_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Eleve::where('id_el',$id)->first();
		return view('eleve.edit')->with($giwu);
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
			$dataInitiale = Eleve::where('id_el',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);

			$newUpd=Eleve::where('id_el',$id)->first();

			//Condition de modification sur Photo
			$datas['photo_el']=$newUpd->photo_el;
			$file1 = $request->file('photo_el');
			if($file1){
				!is_null($newUpd->photo_el) && Filestorage::deleteFile('avatar',$newUpd->photo_el,"");
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'jpeg' && $extension != 'jpg' && $extension != 'png'){
					return Redirect::back()->withInput()->with('error',"Le fichier (Photo) doit &ecirc;tre de type image (*.jpeg, *.jpg, *.png).");
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/docs/";
				$file1->move($pathName, $filename);
				$datas['photo_el']=$filename;
			}
			$newUpd->nom_el = $datas['nom_el'];
			$newUpd->prenom_el = $datas['prenom_el'];
			$newUpd->matricule_el = $datas['matricule_el'];
			$newUpd->date_nais_el = $datas['date_nais_el'];
			$newUpd->sexe_el = $datas['sexe_el'];
			$newUpd->photo_el = $datas['photo_el'];
			$newUpd->tuteur_el = $datas['tuteur_el'];
			$newUpd->email_el = $datas['email_el'];
			$newUpd->tel_el = $datas['tel_el'];
			$newUpd->ecole_id = $datas['ecole_id'];
			$newUpd->save();

			GiwuSaveTrace::enregistre("Modification eleve : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('eleve.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Eleve::where('id_el',$id)->first();
		return view('eleve.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Eleve::find($id)->toArray();
			$affectedRows = Eleve::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du eleve : ".$dataSupp);
				return redirect()->route('eleve.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Eleve::getListEleve($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_el'] = $giw->id_el;
				$tablgiwu[$i]['nom_el'] = $giw->nom_el;
				$tablgiwu[$i]['prenom_el'] = $giw->prenom_el;
				$tablgiwu[$i]['matricule_el'] = $giw->matricule_el;
				$tablgiwu[$i]['date_nais_el'] = date('d/m/Y',strtotime($giw->date_nais_el));
				$tablgiwu[$i]['sexe_el'] = $giw->sexe_el;
				$tablgiwu[$i]['photo_el'] = $giw->photo_el;
				$tablgiwu[$i]['tuteur_el'] = $giw->tuteur_el;
				$tablgiwu[$i]['email_el'] = $giw->email_el;
				$tablgiwu[$i]['tel_el'] = $giw->tel_el;
				$tablgiwu[$i]['ecole'] = isset($giw->ecole) ? $giw->ecole->nom_eco : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsEleve', $Resultat);
		return Excel::download(new EleveExportExcel, 'EleveExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Eleve::getListEleve($req)->get();
		$pdf = PDF::loadView('eleve.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('eleve-'.date('Ymdhis').'.pdf');
	}

	


}


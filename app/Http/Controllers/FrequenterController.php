<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu
	*/
namespace App\Http\Controllers;

use App\Imports\ElevesImport;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use App\Http\Controllers\EmploitempController;
use Auth;
use App\Models\Frequenter;
use App\Models\Eleve;
use App\Models\Ecole;
use App\Models\Promotion;
use App\Models\Emploitemp;
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

		$array = GiwuService::Path_Image_menu("/param/frequenter");
       // dd($array);
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
		$array = GiwuService::Path_Image_menu("/param/frequenter/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listeleve_id'] = Eleve::sltListEleve();
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
		$giwu['promotion'] = Promotion::find(session('promotion_idSess'));
		return view('frequenter.create')->with($giwu);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
    try {
        $datas = $request->all();
        unset($datas['_token']);
		
        $existingFrequenter = Frequenter::where('eleve_id', $datas['eleve_id'])->first();
        if ($existingFrequenter) {
            return Redirect::back()->withInput()->with('error', "Cet élève fréquente déjà une autre promotion.");
        }
		$datas['mail'] = $request->has('mail') ? true : false;
        $datas['whatsapp'] = $request->has('whatsapp') ? true : false;
        $datas['sms'] = $request->has('sms') ? true : false;
        $newAdd = new Frequenter();
        $newAdd->eleve_id = $datas['eleve_id'];
        $newAdd->promotion_id = $datas['promotion_id'];
		$newAdd->send_mail = $datas['mail'];
        $newAdd->send_whatsapp = $datas['whatsapp'];
        $newAdd->send_sms = $datas['sms'];
        $newAdd->save();
        GiwuSaveTrace::enregistre('Ajout du nouveau frequenter : '.GiwuService::DetailInfosInitial($newAdd->toArray()));

        return Redirect::back()->with('success', trans('data.infos_add'));
    } catch (\Illuminate\Database\QueryException $e) {
        return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
    }
}
    public function ChargerAppelEmploi(){

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
		$array = GiwuService::Path_Image_menu("/param/frequenter/edit");
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

			$datas['mail'] = $request->has('mail') ? true : false;
			$datas['whatsapp'] = $request->has('whatsapp') ? true : false;
			$datas['sms'] = $request->has('sms') ? true : false;
			$newUpd=Frequenter::where('id_freq',$id)->first();
			$newUpd->eleve_id = $datas['eleve_id'];
			$newUpd->promotion_id = $datas['promotion_id'];
			$newUpd->send_mail = $datas['mail'];
			$newUpd->send_whatsapp = $datas['whatsapp'];
			$newUpd->send_sms = $datas['sms'];
			$newUpd->save();

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

	public static function AffichePopAction($id){
        $giwu['item'] = Frequenter::find($id);
		$giwu['promotion'] = Promotion::find(session('promotion_idSess'));
		return view('frequenter.action')->with($giwu);
    }
	public static function AffichePopUp(){
		$texte="Veuillez d'abord choisir une école, une année et une promotion.";
		return view('frequenter.pop-up');
    }
	
		public function  importEleve(Request $req){
			try {
				$import = new ElevesImport();
				Excel::import($import, $req->file('fichier_excel'));
				$importErrors = $import->getImportErrors();
				$importedCount = $import->getImportedCount();
				$skippedCount = $import->getSkippedCount();
				$erroFile = "";
				if (!empty($importErrors)) {
					foreach ($importErrors as $error) {
						$erroFile .= '<br>'.$error;
					}
					$message = "<br>&nbsp;Fin importation : <br><li>Lignes importées : $importedCount.</li><br><li>Lignes non importées : $skippedCount.</li>";
					$erroFile .= '<br>'.$message;
					return Redirect::back()->with('error', $erroFile);
				} else {
					$message = "Fichier importé avec succès.<li>Lignes importées : $importedCount; <li>Lignes non importées : $skippedCount.";
					return Redirect::back()->with('success', $message);
				}
			} catch (\Illuminate\Database\QueryException $e) {
				// $message = "Lignes importées : $importedCount,  lignes non importées : $skippedCount.";
				return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
			}
		}
 
	


}


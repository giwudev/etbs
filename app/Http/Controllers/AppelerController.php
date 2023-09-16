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
use App\Utilities\FileStorage;
use App\Exports\AppelerExportExcel;
use PDF;
use Validator;


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
		$giwu['listemploi_id'] = Emploitemp::sltListAppelProfesseur();
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

	public function ConfirmerPresence($id) {
		//
		$appel = Appeler::where('id_appel',$id)->first();
		if($appel){
			if($appel->etat_appel == true){ //EN ATTENTE DE CONFIRMATION
				$appel->etat_appel = false;
			}else{ //PRESENCE CONFIRMEE
				$appel->etat_appel = true;
			}
            $appel->init_id = Auth::id();
			$appel->save();
			return response()->json(['response'=>'1','etat'=>$appel->etat_appel]);
		}
		return response()->json(['response'=>'0','etat'=>'']);
	}

    public static function AffichePopAction($id)
    {
        $giwu['item'] = Appeler::find($id);
		return view('appeler.action')->with($giwu);
    }

    public static function AddJustif(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'justifier' => 'required',
			'motif_just' => 'required',
		]);

		if($validator->fails()){
			return response()->json(['response' => $validator->errors()]);
		}else{
			$datas = $request->all();

			if(!isset($datas['fichier_justif'])){
				return response()->json(['response' => array('fichier_justif' => 'Le champs est obligatoire.')]);
			}

			unset($datas['_token']);
			//Condition sur fichier
			$datas['fichier_justif']="";
			$file1 = $request->file('fichier_justif');
			if($file1){
				$extension = strtolower($file1->getClientOriginalExtension());
				if($extension != 'pdf'){
					return response()->json(['response' => array('fichier_justif'=>'Le fichier doit &ecirc;tre de type PDF.')]);
				}
				$filename=FileStorage::setFile('avatar',$file1,"","");
				$pathName = "assets/docs/";
				$file1->move($pathName, $filename);
				$datas['fichier_justif']=$filename;
			}
			$id = $datas['id_appel'];
			$newUpd=Appeler::where('id_appel',$id)->first();

			$newUpd->justifier = $datas['justifier'];
			$newUpd->motif_just = $datas['motif_just'];
			$newUpd->fichier_justif = $datas['fichier_justif'];
			$newUpd->save();
			return response()->json(['response' => 1]);
		}

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
        $Resultat = Appeler::getListAppelPDF($req)->get();
        $firstRecord = $Resultat->first();
        if ($firstRecord) {
            $date = $firstRecord->created_at->format('d/m/Y');
            $heure =  $firstRecord->emploitemp->discipline->code_disci. ' ' .$firstRecord->emploitemp->promotion->libelle_pro . ' ' . substr($firstRecord->emploitemp->heure_debut,0,5) . ' à ' .substr( $firstRecord->emploitemp->heure_fin,0,5);
            $title = $date . ' | ' . $heure;
        }
        $pdf = PDF::loadView('appeler.pdf', ['list' => $Resultat, 'title' => $title])->setPaper('a4', 'landscape');

        return $pdf->stream('appeler-'. date('Ymdhis') . '.pdf');



    }




}


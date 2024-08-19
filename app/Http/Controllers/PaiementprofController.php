<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Models\User;
use App\Models\Ecole;
use App\Models\PayerProf;
use App\Models\Paiementprof;
use Illuminate\Http\Request;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaiementprofExportExcel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class PaiementprofController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/paie/paiementprof");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Paiementprof::getPaiementProf($req)->paginate(20);
		$giwu['listid_prof'] = User::getListeProf();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		if($req->ajax()) {
			return view('paiementprof.index-search')->with($giwu);
		}
		return view('paiementprof.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/paie/paiementprof/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listid_prof'] = User::getListeProf();
		
		return view('paiementprof.create')->with($giwu);
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
			// Validation des données de base
			$validator = Validator::make($request->all(), [
				'id_prof' => 'required',
				'datedebut' => 'required|date',
				'datefin' => 'required|date|after:datedebut',
				'description.*' => 'required|string',
				'qte.*' => 'required|integer|min:1',
				'PrixUnitaire.*' => 'required|integer|min:1',
				'montant.*' => 'required|integer|min:1',
			], [
				'datefin.after' => 'La date de fin doit être postérieure à la date de début.',
			]);
			// Validation du tableau de paiements
			$paiements = $request->input('description');
			if (empty($paiements) || count($paiements) == 0) {
				$validator->after(function ($validator) {
					$validator->errors()->add('paiements', 'Vous devez ajouter au moins une ligne de paiement.');
				});
			}
			if ($validator->fails()) {
				return Redirect::back()->withInput()->with('error', implode(' ', $validator->errors()->all()));
			}
			// Création de l'entrée de base dans la table PaiementProf
			$paiementProf = new PaiementProf();
			$paiementProf->id_prof = $request->id_prof;
			$paiementProf->datedebut = $request->datedebut;
			$paiementProf->datefin = $request->datefin;
			$paiementProf->payer_bool = 0;
			$paiementProf->montant_total = 0; 
			$paiementProf->init_id = Auth::id(); 
			$paiementProf->etablis_id = session('etablis_idSess'); 
			$paiementProf->save();

			$montantTotal = 0;
			// Ajout des lignes dans la table PayerProf
			foreach ($request->description as $key => $description) {
				$payerProf = new PayerProf();
				$payerProf->paiement_id = $paiementProf->id_paie;
				$payerProf->description = $description;
				$payerProf->qte = $request->qte[$key];
				$payerProf->PrixUnitaire = $request->PrixUnitaire[$key];
				$payerProf->montant = $request->montant[$key];
				$payerProf->save();
				
				$montantTotal += $request->montant[$key];
			}
			// Mise à jour du montant total dans PaiementProf
			$paiementProf->montant_total = $montantTotal;
			$paiementProf->save();

			GiwuSaveTrace::enregistre('Paiement ajouté avec succès. : '.GiwuService::DetailInfosInitial($paiementProf->toArray()));
			return redirect()->route('paiementprof.index')->with('success', 'Paiement ajouté avec succès.');
		
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
		$array = GiwuService::Path_Image_menu("/paie/paiementprof/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listid_prof'] = User::getListeProf();
		$giwu['item'] = Paiementprof::where('id_paie',$id)->first();
		// Récupérer les détails de paiement associés
		$giwu['paiements'] = PayerProf::where('paiement_id', $id)->get();
		return view('paiementprof.edit')->with($giwu);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		try {
			// Validation des données de base
			$validator = Validator::make($request->all(), [
				'datedebut' => 'required|date',
				'datefin' => 'required|date|after:datedebut',
				'description.*' => 'required|string',
				'qte.*' => 'required|integer|min:1',
				'PrixUnitaire.*' => 'required|numeric|min:1',
				'montant.*' => 'required|numeric|min:1',
			], [
				'datefin.after' => 'La date de fin doit être postérieure à la date de début.',
			]);
	
			// Validation du tableau de paiements
			$paiements = $request->input('description');
			if (empty($paiements) || count($paiements) == 0) {
				$validator->after(function ($validator) {
					$validator->errors()->add('paiements', 'Vous devez ajouter au moins une ligne de paiement.');
				});
			}
	
			if ($validator->fails()) {
				return Redirect::back()->withInput()->withErrors($validator)->with('error', 'Veuillez corriger les erreurs ci-dessous.');
			}
	
			// Récupération de l'élément à mettre à jour
			$paiement = Paiementprof::findOrFail($id);
	
			// Mise à jour des champs principaux
			$paiement->id_prof = $request->input('id_prof');
			$paiement->datedebut = $request->input('datedebut');
			$paiement->datefin = $request->input('datefin');
			// Calcul du montant total
			$montants = $request->input('montant');
			$montantTotal = array_sum($montants);
	
			// Mise à jour du montant total dans l'objet Paiementprof
			$paiement->montant_total = $montantTotal;
			$paiement->save();
	
			// Suppression des anciens détails de paiement
			PayerProf::where('paiement_id', $id)->delete();
	
			// Mise à jour des détails de paiement
			$descriptions = $request->input('description');
			$quantites = $request->input('qte');
			$prixUnitaire = $request->input('PrixUnitaire');
			$montants = $request->input('montant');
	
			foreach ($descriptions as $index => $description) {
				PayerProf::create([
					'paiement_id' => $id,
					'description' => $description,
					'qte' => $quantites[$index],
					'PrixUnitaire' => $prixUnitaire[$index],
					'montant' => $montants[$index],
				]);
			}
	
			GiwuSaveTrace::enregistre('Paiement modifier avec succès. : '.GiwuService::DetailInfosInitial($paiement->toArray()));

			return redirect()->route('paiementprof.index')->with('success', 'Paiement ajouté avec succès.');

		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with('errorMsg', $e->getMessage());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function AffichePopDelete($id) {
		$giwu['item'] = Paiementprof::where('id_paie',$id)->first();
		return view('paiementprof.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Paiementprof::find($id)->toArray();
			$affectedRows = Paiementprof::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du paiementprof : ".$dataSupp);
				return redirect()->route('paiementprof.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}
	// PaiementprofController.php

	public function togglePayment($id) {
		try {
			// Récupération de l'élément
			$paiement = Paiementprof::findOrFail($id);

			// Changement de l'état de paiement
			$paiement->payer_bool = !$paiement->payer_bool;
			$paiement->save();

			// Redirection avec succès
			return redirect()->route('paiementprof.index')->with('success', trans('data.infos_update'));
			
		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			// Gestion des erreurs
			return redirect()->route('paiementprof.index')->with('error', trans('data.infos_error'))->with('errorMsg', $e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Paiementprof::getPaiementProf($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_paie'] = $giw->id_paie;
				$tablgiwu[$i]['id_prof'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$tablgiwu[$i]['datedebut'] = date('d/m/Y',strtotime($giw->datedebut));
				$tablgiwu[$i]['datefin'] = date('d/m/Y',strtotime($giw->datefin));
				$tablgiwu[$i]['montant_total'] = $giw->montant_total;
				$tablgiwu[$i]['payer_bool'] = $giw->payer_bool;
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsPaiementprof', $Resultat);
		return Excel::download(new PaiementprofExportExcel, 'PaiementprofExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Paiementprof::getPaiementProf($req)->get();
		$pdf = PDF::loadView('paiementprof.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('paiementprof-'.date('Ymdhis').'.pdf');
	}

	


}


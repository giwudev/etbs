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
use App\Models\Trimsem;
use App\Models\Anneesco;
use App\Models\Appeler;
use App\Models\Frequenter;
use App\Models\User;
use App\Models\Ecole;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrimsemExportExcel;
use PDF;
use Carbon\Carbon;


class TrimsemController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {

		$array = GiwuService::Path_Image_menu("/param/trimsem");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = Trimsem::getListTrimSemestre($req)->paginate(20);
		$giwu['listannee_id'] = Anneesco::sltListAnneesco();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		if($req->ajax()) {
			return view('trimsem.index-search')->with($giwu);
		}
		return view('trimsem.index')->with($giwu);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/trimsem/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listannee_id'] = Anneesco::sltListAnneesco();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		return view('trimsem.create')->with($giwu);
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

        if ($datas['date_debut'] >= $datas['date_fin']) {return Redirect::back()->withInput()->with('error', "La date de début doit être inférieure à la date de fin.");}
        $anneeScolaire = Anneesco::find($datas['annee_id']);
        if ($datas['date_debut'] < $anneeScolaire->annee_debut || $datas['date_fin'] > $anneeScolaire->annee_fin.'-12-31') {return Redirect::back()->withInput()->with('error', "Les dates doivent être incluses dans l'année scolaire en cours.");}
		$existingPeriod = TrimSem::where(function ($query) use ($datas) {$query->where('date_debut', '<=', $datas['date_debut'])->where('date_fin', '>=', $datas['date_debut']);})->orWhere(function ($query) use ($datas) {$query->where('date_debut', '<=', $datas['date_fin'])->where('date_fin', '>=', $datas['date_fin']);})->first();
		if ($existingPeriod) {return Redirect::back()->withInput()->with('error', "Une période active chevauche déjà la plage de période que vous souhaitez ajouter.");}
		
        $newAdd = new Trimsem();
        $newAdd->libelle_trimSem = $datas['libelle_trimSem'];
        $newAdd->statut_trimSem = $datas['statut_trimSem'];
        $newAdd->annee_id = $datas['annee_id'];
        $newAdd->date_debut = $datas['date_debut'];
        $newAdd->date_fin = $datas['date_fin'];
        $newAdd->init_id = Auth::id();
		$newAdd->save();

        // $dateDebut = Carbon::parse($datas['date_debut']);
        // $dateFin = Carbon::parse($datas['date_fin']);
        // $nombreJours = 0;
        // $currentDate = $dateDebut->copy();
        // $datesArray = [];
        // while ($currentDate->lte($dateFin)) {
        //     if (!$currentDate->isSaturday() && !$currentDate->isSunday()) {
        //         $nombreJours++;
        //         $datesArray[] = $currentDate->toDateString();
        //     }
        //     $currentDate->addDay();
        // }
		// dd($nombreJours,$datesArray);

        // $eleves = Frequenter::with(['eleve','promotion','promotion.classe','promotion.classe.anneesco'])
		// 						->select('eleve_id')->get();
		// $CheckAppli = $CheckAppli->WhereHas('partappli', function ($q){
		// 	$q->where('etat_appli','a');
		// })->first();
        // $appel= [];
        // foreach ($eleves as $eleve) {
        //     for ($i = 0; $i < $nombreJours; ) {
        //         if (!$dateDebut->isSaturday() && !$dateDebut->isSunday()) {
        //             $newAppel = new Appeler();
        //             $newAppel->eleve_id = $eleve->eleve_id;
        //             $newAppel->init_id = Auth::id();
        //             $newAppel->date_presence = $datesArray[$i];
        //             $newAppel->save();
        //             $i++;
        //            // array_push($appel,$newAppel);
        //         }
        //         $dateDebut->addDay();
        //        // dd($appel) ;
        //     }
        // }
        GiwuSaveTrace::enregistre('Ajout du nouveau trimsem : '.GiwuService::DetailInfosInitial($newAdd->toArray()));
        return Redirect::back()->with('success', trans('data.infos_add'));
    } catch (\Illuminate\Database\QueryException $e) {
        return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
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

		$array = GiwuService::Path_Image_menu("/param/trimsem/edit");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listannee_id'] = Anneesco::sltListAnneesco();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		$giwu['listinit_id'] = User::sltListUser();
		$giwu['item'] = Trimsem::where('id_trimSem',$id)->first();
		return view('trimsem.edit')->with($giwu);
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
			$dataInitiale = Trimsem::where('id_trimSem',$id)->first()->toArray();
			$datas = $request->all();
			unset($datas['_token']);
			$newUpd=Trimsem::where('id_trimSem',$id)->first();
            if ($datas['date_debut'] >= $datas['date_fin']) {return Redirect::back()->withInput()->with('error', "La date de début doit être inférieure à la date  de fin.");}
            $anneeScolaire = Anneesco::find($datas['annee_id']);
			if ($datas['date_debut'] < $anneeScolaire->annee_debut || $datas['date_fin'] > $anneeScolaire->annee_fin.'-12-31') {return Redirect::back()->withInput()->with('error', "Les dates doivent être incluses dans l'année scolaire en cours.");}
			$existingPeriod = TrimSem::where(function ($query) use ($datas) {$query->where('date_debut', '<=', $datas['date_debut'])->where('date_fin', '>=', $datas['date_debut']);})->orWhere(function ($query) use ($datas) {$query->where('date_debut', '<=', $datas['date_fin'])->where('date_fin', '>=', $datas['date_fin']);})->first();
			if ($existingPeriod->id_trimSem !=$newUpd->id_trimSem ) {return Redirect::back()->withInput()->with('error', "Une période active chevauche déjà la plage de période que vous souhaitez ajouter.");}
			
			$newUpd->libelle_trimSem = $datas['libelle_trimSem'];
			$newUpd->statut_trimSem = $datas['statut_trimSem'];
			$newUpd->annee_id = $datas['annee_id'];
            $newUpd->date_debut = $datas['date_debut'];
            $newUpd->date_fin = $datas['date_fin'];
			$newUpd->save();
			GiwuSaveTrace::enregistre("Modification trimsem : ".GiwuService::DiffDetailModifier($dataInitiale,$newUpd->toArray()));
			return redirect()->route('trimsem.index')->with('success',trans('data.infos_update'));
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
		$giwu['item'] = Trimsem::where('id_trimSem',$id)->first();
		return view('trimsem.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Trimsem::find($id)->toArray();
			$affectedRows = Trimsem::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du trimsem : ".$dataSupp);
				return redirect()->route('trimsem.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Trimsem::getListTrimSemestre($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['libelle_trimSem'] = $giw->libelle_trimSem;
				$tablgiwu[$i]['statut_trimSem'] = $giw->statut_trimSem;
				$tablgiwu[$i]['anneesco'] = isset($giw->anneesco) ? $giw->anneesco->annee_debut : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsTrimsem', $Resultat);
		return Excel::download(new TrimsemExportExcel, 'TrimsemExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Trimsem::getListTrimSemestre($req)->get();
		$pdf = PDF::loadView('trimsem.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('trimsem-'.date('Ymdhis').'.pdf');
	}
}


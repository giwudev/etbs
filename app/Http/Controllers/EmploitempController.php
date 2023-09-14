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
use App\Models\Emploitemp;
use App\Models\Discipline;
use App\Models\Promotion;
use App\Models\Anneesco;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Ecole;
use App\Models\Frequenter;
use App\Models\Appeler;
use App\Exports\EmploitempExportExcel;
use PDF;


class EmploitempController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $req) {
    $array = GiwuService::Path_Image_menu("/param/emploitemp");
     dd($array);
    if ($array['titre'] == "") {
        return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);
    } else {
        foreach ($array as $name => $data) {
            $giwu[$name] = $data;
        }
    }

    $giwu['list'] = Emploitemp::getListEmploieTemps($req)->paginate(20);
    $giwu['listdiscipline_id'] = Discipline::sltListDiscipline();
    $giwu['listpromotion_id'] = Promotion::sltListPromotion();
    $giwu['listannee_id'] = Anneesco::sltListAnneesco();
    $giwu['listprof_id'] = User::sltListUser();
    $giwu['listinit_id'] = User::sltListUser();
    $giwu['listetablis_id'] = Ecole::sltListEcole();
    if ($req->ajax()) {
        return view('emploitemp.index-search')->with($giwu);
    }
    return view('emploitemp.index')->with($giwu);
}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$array = GiwuService::Path_Image_menu("/param/emploitemp/create");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['listdiscipline_id'] = Discipline::sltListDiscipline();
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
		$giwu['listannee_id'] = Anneesco::sltListAnneesco();
		$giwu['listprof_id'] = User::sltListProf();
		$giwu['listinit_id'] = User::sltListUser();
        return view('emploitemp.create')->with($giwu);
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

			if ($datas['heure_debut'] >= $datas['heure_fin']) {
				return Redirect::back()->withInput()->with('error', "L'heure de début doit être inférieure à l'heure de fin.");
			}

			$existingEmploiTemp = Emploitemp::where('jour_semaine', $datas['jour_semaine'])
<<<<<<< Updated upstream
					->where('promotion_id',$datas['promotion_id'])
					->where(function ($query) use ($datas) {
						$query->where('heure_debut', '<=', $datas['heure_fin'])
							->where('heure_fin', '>=', $datas['heure_debut']);
					})
					->first();
=======
				->where('promotion_id',$datas['promotion_id'])
				->where(function ($query) use ($datas) {
					$query->where('heure_debut', '<=', $datas['heure_fin'])
						->where('heure_fin', '>=', $datas['heure_debut']);
				})
				->first();
>>>>>>> Stashed changes

			if ($existingEmploiTemp) {
				return Redirect::back()->withInput()->with('error', "Cette plage horaire est déjà prise par une autre matière.");
			}

			$newAdd = new Emploitemp();
			$newAdd->heure_debut = substr($datas['heure_debut'], 0, 5);
			$newAdd->heure_fin = substr($datas['heure_fin'], 0, 5);
			$newAdd->jour_semaine = $datas['jour_semaine'];
			$newAdd->discipline_id = $datas['discipline_id'];
			$newAdd->promotion_id = $datas['promotion_id'];
			$newAdd->annee_id = $datas['annee_id'];
			$newAdd->prof_id = $datas['prof_id'];
			$newAdd->nbreheure = Emploitemp::DifferenceTime($newAdd->heure_debut,$newAdd->heure_fin);
			$newAdd->init_id = Auth::id();
			$newAdd->save();
			//Creation des lignes dans la table Appeler
			// self::ChargerAppel($newAdd->promotion_id,$newAdd->id_empl);

			GiwuSaveTrace::enregistre('Ajout du nouveau emploi de temps : '.GiwuService::DetailInfosInitial($newAdd->toArray()));

			return Redirect::back()->with('success', trans('data.infos_add'));
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
		}
	}

    public function ChargerAppel($idPromo,$idEmploi){

        // $eleve = Frequenter::where('promotion_id', $idPromo)->get();
        // foreach ($eleve as $el){
        //     $appel = new Appeler();
        //     $appel->emploi_id = $idEmploi;
        //     $appel->eleve_id = $el->eleve_id;
        //     $appel->etat_appel = false;
        //     $appel->init_id = Auth::id();
        //     $appel->save();
        // }
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
        $array = GiwuService::Path_Image_menu("/param/emploitemp/edit");
        if ($array['titre'] == "") {
            return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);
        } else {
            foreach ($array as $name => $data) {
                $giwu[$name] = $data;
            }
        }

        $giwu['listdiscipline_id'] = Discipline::sltListDiscipline();
        $giwu['listpromotion_id'] = Promotion::sltListPromotion();
        $giwu['listannee_id'] = Anneesco::sltListAnneesco();
        $giwu['listprof_id'] = User::sltListUser();
        $giwu['listinit_id'] = User::sltListUser();

        // Fetch the item being edited
        $giwu['item'] = Emploitemp::where('id_empl', $id)->first();

        return view('emploitemp.edit')->with($giwu);
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
            $dataInitiale = Emploitemp::where('id_empl', $id)->first()->toArray();

            $datas = $request->all();
            unset($datas['_token']);
            if ($datas['heure_debut'] >= $datas['heure_fin']) {
                return Redirect::back()->withInput()->with('error', "L'heure de début doit être inférieure à l'heure de fin.");
            }

            // $existingEmploiTemp = Emploitemp::where('jour_semaine', $datas['jour_semaine'])
			// 	->where('promotion_id',$datas['promotion_id'])
            //     ->where(function ($query) use ($datas) {
            //         $query->where('heure_debut', '<=', $datas['heure_fin'])->where('heure_fin', '>=', $datas['heure_debut']);
            //     })->first();
            // if ($existingEmploiTemp) {
            //     return Redirect::back()->withInput()->with('error', "Cette plage horaire est déjà prise par une autre matière.");
            // }
            //Faire une vérification sur la promotion avant la suppression
            $newUpd = Emploitemp::where('id_empl', $id)->first();

            if ($datas['promotion_id'] != $newUpd->promotion_id) {
                //Applique la suppression
                Appeler::where('emploi_id', $id)->delete();
            }
            $newUpd->heure_debut 	= $datas['heure_debut'];
            $newUpd->heure_fin 		= $datas['heure_fin'];
            $newUpd->jour_semaine 	= $datas['jour_semaine'];
            $newUpd->discipline_id 	= $datas['discipline_id'];
            $newUpd->promotion_id 	= $datas['promotion_id'];
            $newUpd->annee_id 		= $datas['annee_id'];
            $newUpd->prof_id 		= $datas['prof_id'];
			$newUpd->nbreheure = Emploitemp::DifferenceTime($newUpd->heure_debut,$newUpd->heure_fin);
            $newUpd->save();
            // self::ChargerAppel($newUpd->promotion_id,$id);

            GiwuSaveTrace::enregistre("Modification emploitemp : " . GiwuService::DiffDetailModifier($dataInitiale, $newUpd->toArray()));
            return redirect()->route('emploitemp.index')->with('success', trans('data.infos_update'));
        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
        }
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function AffichePopDelete($id) {
		$giwu['item'] = Emploitemp::where('id_empl',$id)->first();
		return view('emploitemp.delete')->with($giwu);
	}

	public function destroy($id) {
		//
		try {
			$dataInitiale = Emploitemp::find($id)->toArray();
			$affectedRows = Emploitemp::find($id)->delete();
			if ($affectedRows) {
				$dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
				GiwuSaveTrace::enregistre("Suppression du emploitemp : ".$dataSupp);
				return redirect()->route('emploitemp.index')->with('success',trans('data.infos_delete'));
			}
		} catch (\Illuminate\Database\QueryException $e) {
			return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
		}
	}

	public function exporterExcel(Request $req) {
		$Resultat = Emploitemp::getListEmploieTemps($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_empl'] = $giw->id_empl;
				$tablgiwu[$i]['heure_debut'] = $giw->heure_debut;
				$tablgiwu[$i]['heure_fin'] = $giw->heure_fin;
				$tablgiwu[$i]['jour_semaine'] = $giw->jour_semaine;
				$tablgiwu[$i]['discipline'] = isset($giw->discipline) ? $giw->discipline->code_disci : trans('data.not_found');
				$tablgiwu[$i]['promotion'] = isset($giw->promotion) ? $giw->promotion->libelle_pro : trans('data.not_found');
				$tablgiwu[$i]['anneesco'] = isset($giw->anneesco) ? $giw->anneesco->annee_debut : trans('data.not_found');
				$tablgiwu[$i]['prof_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$tablgiwu[$i]['init_id'] = isset($giw->users_g) ? $giw->users_g->name.' '.$giw->users_g->prenom : trans('data.not_found');
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsEmploitemp', $Resultat);
		return Excel::download(new EmploitempExportExcel, 'EmploitempExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = Emploitemp::getListEmploieTemps($req)->get();
		$pdf = PDF::loadView('emploitemp.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('emploitemp-'.date('Ymdhis').'.pdf');
	}




}


<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Http\Controllers\Cons;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Frequenter;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use Auth,DateTime,DB;
use App\Models\Promotion;
use App\Models\Ecole;
use App\Models\Trimsem;
use App\Models\Anneesco;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Consult\listnoteconduiteConsExportExcel;
use PDF;


class ConslistnoteconduiteController extends Controller {

	public static function getListEleveFrequente(Request $req){

		$query = Frequenter::with(['eleve','promotion'])->orderBy('created_at','desc');

		$checkAction = $req->get('id_giwu');
		if(isset($checkAction)){
			//recherche simple
			$recherche = $req->get('query');
			if(isset($recherche)){
				$query->where(function ($query) Use ($recherche){					
					$query->where('eleve_id','like','%'.strtoupper(trim($recherche).'%'));
				});
				//Recherche avancee sur eleve
				$query->orWhereHas('eleve', function ($q) use ($recherche) {
					$q->where('nom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
					$q->orwhere('prenom_el', 'like', '%'.strtoupper(trim($recherche).'%'));
				});
			}
			$trimSem = $req->get('periode_id');
			if(isset($trimSem)){
				Session()->put('periode_id', $trimSem);
			}else{
				Session()->put('periode_id','');
			}
			
			//Promotion
			$promotion_idr = $req->get('promotion_id');
			if(isset($promotion_idr)){
				Session()->put('promotion_idSess', $promotion_idr);
			}else{
				Session()->put('promotion_idSess','');
			}
			$query->where('promotion_id',$promotion_idr);
		}
		return $query;
	}

		
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function listnoteconduiteCons(Request $req) {

		$array = GiwuService::Path_Image_menu("/cons/listnoteconduite");
		if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
		$giwu['list'] = self::getListEleveFrequente($req)->paginate(20);
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
		$giwu['listPeriode'] = Trimsem::sltListTrimsem();
		$giwu['listetablis_id'] = Ecole::sltListEcole();
		$giwu['listannee_id'] = Anneesco::sltListAnneesco();
		if($req->ajax()) {
			return view('cons.listnoteconduite.index-search')->with($giwu);
		}
		return view('cons.listnoteconduite.index')->with($giwu);
	}

	public function exporterExcel(Request $req) {
		$Resultat = self::getListEleveFrequente($req)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['id_freq'] = $giw->id_freq;
				$tablgiwu[$i]['eleve'] = isset($giw->eleve) ? $giw->eleve->nom_el : trans('data.not_found');
				$tablgiwu[$i]['promotion'] = isset($giw->promotion) ? $giw->promotion->libelle_pro : trans('data.not_found');
				$tablgiwu[$i]['created_at'] = $giw->created_at;
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlslistnoteconduite', $Resultat);
		return Excel::download(new listnoteconduiteConsExportExcel, 'listnoteconduiteExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}

	public function exporterPdf(Request $req) {
		$Resultat = self::getListEleveFrequente($req)->get();
		$pdf = PDF::loadView('cons.listnoteconduite.pdf',['list' => $Resultat])->setPaper('a4','landscape');
		return $pdf->stream('listnoteconduite-'.date('Ymdhis').'.pdf');
	}

	


}


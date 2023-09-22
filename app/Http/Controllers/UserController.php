<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\GiwuSaveTrace;
use App\Providers\GiwuService;
use App\Models\User;
use App\Models\GiwuRole;
use App\Models\Ecole;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Exports\UserExportExcel;
use App\Imports\ElevesImport;
use App\Imports\ProfImport;
use App\Models\Promotion;
use App\Models\Trimsem;
use Ramsey\Uuid\Uuid;
use Auth,Hash,PDF;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $array = GiwuService::Path_Image_menu("/admin/user");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer'=>trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['list'] = User::getListeUsers($req)->paginate(10);
        $giwu['listEcole_id'] = Ecole::sltListEcole();
        if($req->ajax()) {
			return view('users.index-search')->with($giwu);
		}
        return view('users.index')->with($giwu);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $array = GiwuService::Path_Image_menu("/admin/user/create");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['sltRole'] = GiwuRole::sltListRole();
        $giwu['listEcole_id'] = Ecole::sltListEcole();
		$giwu['promotion'] = Promotion::find(session('promotion_idSess'));
        return view('users.create')->with($giwu);
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
            $email = $datas['email'];
            if(User::where('email',$email)->count() != 0){
                return Redirect::back()->withInput()->with('error',"Ce mail existe déjà.");
            }
            unset($datas['_token']);
            $datas['password']=Hash::make('123');
            $datas['id_ini']=Auth::id();
            $datas['code']=Uuid::uuid4();
            $datas['image_profil'] = trans('data.img_defaut');
            $new = User::create($datas);
            GiwuSaveTrace::enregistre('Ajout du nouveau utilisateur : '.GiwuService::DetailInfosInitial($new->toArray()));
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $array = GiwuService::Path_Image_menu("/admin/user");
        if($array['titre']==""){return Redirect::to('weberror')->with(['typeAnswer' => trans('data.MsgCheckPage')]);}else{foreach($array as $name => $data){$giwu[$name] = $data;}}
        $giwu['sltRole'] = GiwuRole::sltListRole();
        $giwu['user'] = User::whereCode($code)->first();
        $giwu['listEcole_id'] = Ecole::sltListEcole();
        return view('users.edit')->with($giwu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        try {
            $dataInitiale = User::where('code', $code)->first()->toArray();
            $user=User::whereCode($code)->first();
            $datas = $request->all();
            $email = $datas['email'];
            $count = User::where('email',$email)->get()->toArray();
            if(count($count) != 0){
                if($count[0]['code'] != $code){
                    return Redirect::back()->withInput()->with('error',"Ce mail existe déjà.");
                }
            }
            unset($datas['_token']);
            $updated=$user->update($datas);
            GiwuSaveTrace::enregistre("Modification de l'utilisateur : ".GiwuService::DiffDetailModifier($dataInitiale,$user->toArray()));
            return redirect()->route('users.index')->with('success',trans('data.infos_update'));

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
        }
    }
    public function AffichePopDelete($code)
    {
        $giwu['item'] = User::whereCode($code)->first();
		return view('users.delete')->with($giwu);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dataInitiale = User::find($id)->toArray();
            $affectedRows = User::find($id)->delete();
            if ($affectedRows) {
                $dataSupp = GiwuService::DetailInfosInitial($dataInitiale);
                GiwuSaveTrace::enregistre("Suppression d'utilisateur : " .$dataSupp);
                return redirect()->route('users.index')->with('success',trans('data.infos_delete'));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withInput()->with('error',trans('data.infos_error'))->with("errorMsg",$e->getMessage());
        }
    }
    
	public function exporterExcel(Request $request){
		$Resultat = User::getListeUsers($request)->get();
		if(sizeof($Resultat) != 0){
			$i = 0;
			foreach($Resultat as $giw){
				$tablgiwu[$i]['name'] = $giw->name;
				$tablgiwu[$i]['prenom'] = $giw->prenom;
				$tablgiwu[$i]['email'] = $giw->email;
				$tablgiwu[$i]['tel_user'] = $giw->tel_user;
				$tablgiwu[$i]['other_infos_user'] = $giw->other_infos_user;
				$tablgiwu[$i]['id_role'] = $giw->role->libelle_role;
				$tablgiwu[$i]['is_active'] = User::EtatUser($giw->is_active);
				$i++;
			}
			$Resultat = new Collection($tablgiwu);
		}
		Session()->put('xlsUser', $Resultat);
		return Excel::download(new UserExportExcel, 'UserExportExcel_'.date('Y-m-d-h-i-s').'.xls');
	}


	public static function exporterPdf(Request $request){

		$Resultat = User::getListeUsers($request)->get();
        $pdf = PDF::loadView('users.pdf',['list' => $Resultat])->setPaper('a4','landscape');
        return $pdf->stream('users-'.date('Ymdhis').'.pdf');
	}
	public static function findPromo($id){
        $promotions = Promotion::findPromotion($id);
        return response()->json(['promotions' => $promotions]);
	}
        public static function AffichePopAction($id){
        $giwu['listEcole_id'] = Ecole::sltListEcole();
		$giwu['listpromotion_id'] = Promotion::sltListPromotion();
        $giwu['item'] = User::find($id);
            $giwu['promotion'] = Promotion::find(session('promotion_idSess'));
            return view('users.action')->with($giwu);
        }
        public function importProf(Request $req){
            try {
                $import = new ProfImport($req->etablis, $req->promo);
				Excel::import($import, $req->file('fichier_excel'));
				$importedCount = $import->getImportedCount();
				$skippedCount = $import->getSkippedCount();
				$message = "Fichier importé avec succès.\nLignes importées : $importedCount\nLignes non importées : $skippedCount.";
				return Redirect::back()->with('success', $message);
			} catch (\Illuminate\Database\QueryException $e) {
				// $message = "Lignes importées : $importedCount,  lignes non importées : $skippedCount.";
				return Redirect::back()->withInput()->with('error', trans('data.infos_error'))->with("errorMsg", $e->getMessage());
			}
		}

        
}

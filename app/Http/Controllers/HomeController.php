<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\GiwuService;
use Auth;
use App\Models\GiwuSociete;
use App\Models\Dossier;
use App\Models\EmploiTemp;
use App\Models\Entite;
use App\Models\Planformation;
use App\Models\Associeragent;
use App\Models\Structureformatrice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    if (session('InfosRole')->id_role == 16) {
        // $giwu['pathMenu'] = "";
    }
    $giwu['pathMenu'] = GiwuService::PathMenu('/');
    // Récupérer l'emploi du temps du professeur connecté
    $emploiDuTemps = EmploiTemp::where('prof_id', auth()->user()->id)->get();

    // Espace admin
    $giwu['image'] = GiwuService::PhotoProfilUtilisateur();
    // Passer les données de l'emploi du temps à la vue
    $giwu['emploiDuTemps'] = $emploiDuTemps;
    return view('home')->with($giwu);
}


}

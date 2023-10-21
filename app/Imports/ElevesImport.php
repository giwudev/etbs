<?php

namespace App\Imports;

use App\Models\Eleve;
use App\Models\Frequenter;
use App\Providers\GiwuService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ElevesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $importErrors = [];
    private $importedCount = 0;
    private $skippedCount = 0;

    public function model(array $row){
        static $firstRow = true; 
        if ($firstRow) {
            $firstRow = false;
            return null; 
        }
        $matricule = $row[0];
        $ecoleId = session('etablis_idSess');
        $existingEleve = Eleve::where('matricule_el', $matricule)->where('ecole_id', $ecoleId)->first();
        if (!$existingEleve) {
            $eleve = new Eleve([
                'matricule_el' => $matricule,
                'nom_el' => $row[1],
                'prenom_el' => $row[2],
                'date_nais_el' => GiwuService::ChangeFormatDateY_m_d($row[3]),
                'sexe_el' => $row[4],
                'tuteur_el' => $row[5],
                'email_el' => $row[6],
                'tel_el' => $row[7],
                'ecole_id' => session('etablis_idSess'),
                'init_id' => Auth::id(),
            ]);
            $eleve->save();
            $this->importedCount++;
            Frequenter::create([
                'eleve_id' => $eleve->id_el,
                'promotion_id' => session('promotion_idSess')
            ]);
            return $eleve;
        } else {
            $this->skippedCount++;
            $this->importErrors[] = "L'élève avec le matricule $matricule existe déjà dans cette école mais ces informations ont été mise à jour.";
            //Mise à jour des données
            $existingEleve->nom_el = $row[1];
			$existingEleve->prenom_el = $row[2];
			$existingEleve->date_nais_el = GiwuService::ChangeFormatDateY_m_d($row[3]);
			$existingEleve->sexe_el = $row[4];
			$existingEleve->tuteur_el = $row[5];
			$existingEleve->email_el = $row[6];
			$existingEleve->tel_el = $row[7];
			$existingEleve->save();
            return null;
        }
    }
    public function getImportErrors(){return $this->importErrors;}
    public function getImportedCount(){return $this->importedCount;}
    public function getSkippedCount(){return $this->skippedCount;}
}

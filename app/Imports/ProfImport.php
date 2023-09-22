<?php

namespace App\Imports;

use App\Models\Definipromotion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class ProfImport implements ToModel{
    /**
    * @param Collection $collection
    */
    protected $promo;
    protected $ecole;

    public function __construct($promo, $ecole){
        $this->promo = $promo;
        $this->ecole = $ecole;
    }
    private $importErrors = [];
    private $importedCount = 0;
    private $skippedCount = 0;
    public function model(array $row) {
       static $firstRow = true; 
        if ($firstRow) {
            $firstRow = false; 
            return null; }
        $email = $row[3];
        $existingUser = User::where('email', $email)->first();
        $prof = new User([
            'name' => $row[0],
            'prenom' => $row[1],
            'tel_user' => $row[2],
            'email' =>$email,
            'other_infos_user' => $row[4],
            'etablis_id' =>$this->ecole,
            'code' =>Uuid::uuid4(),
            'is_active' => true,
            'id_ini' => Auth::id(),
            'init_id' => Auth::id(),
            'id_role' => 16,
            'password'=>Hash::make('123'),
        ]);
        if ($existingUser) {
            $this->skippedCount++;
            return null;
        }else{
            $prof->save();
            Definipromotion::create(['prof_id' => $prof->id, 'promo_id' => $this->promo ,]);
            $this->importedCount++;
            return $prof;
            }
    }
    public function getImportedCount(){return $this->importedCount;}
    public function getSkippedCount(){return $this->skippedCount;}
}

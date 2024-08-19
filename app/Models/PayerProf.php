<?php

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayerProf extends Model
{
    protected $table = 'etbs_payer_prof';

    protected $fillable = [
        'id_payer',
        'paiement_id',
        'description',
        'qte',
        'PrixUnitaire',
        'montant',
    ];
}


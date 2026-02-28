<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dette extends Model
{
    protected $table = 'dettes';

    protected $fillable = [
        'depense_id',
        'colocation_user_id',
        'montant',
        'date_paiement',
        'statut',
    ];

    public function colocationUser()
    {
        return $this->belongsTo(ColocationUser::class);
    }

    public function depense()
    {
        return $this->belongsTo(Depense::class);
    }
}

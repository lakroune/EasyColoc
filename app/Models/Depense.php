<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    /** @use HasFactory<\Database\Factories\DepenceFactory> */
    use HasFactory;

    protected $table = 'depenses';
    protected $fillable = [
        'titre',
        'montant',
        'categorie_id',
        'colocation_user_id',
    ];

    public function colocationUser()
    {
        return $this->belongsTo(ColocationUser::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function dettes()
    {
        return $this->hasMany(Dette::class);
    }
}

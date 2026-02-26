<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CatgorieFactory> */
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nom_categorie',
        'colocation_id',
    ];
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }
}

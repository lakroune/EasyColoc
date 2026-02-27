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
        'title',
        'montant',
    ];

    public function colocationUser()
    {
        return $this->belongsTo(ColocationUser::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}

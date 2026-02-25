<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catgorie extends Model
{
    /** @use HasFactory<\Database\Factories\CatgorieFactory> */
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'nom_categorie',
    ];
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}

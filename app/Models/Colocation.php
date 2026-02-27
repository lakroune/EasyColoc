<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    /** @use HasFactory<\Database\Factories\ColocationFactory> */
    use HasFactory;

    protected $table = 'colocations';

    protected $fillable = [
        'nom_coloc',
        'status',
        'token',
        'owner_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public  function colocationUsers()
    {
        return $this->hasMany(ColocationUser::class);
    }
    public function invetations()
    {
        return $this->hasMany(Invetation::class);
    }
    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }
}

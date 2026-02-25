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
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'colocation_user')->withPivot('is_owner', 'left_at')->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depence extends Model
{
    /** @use HasFactory<\Database\Factories\DepenceFactory> */
    use HasFactory;

    protected $table = 'depences';
    protected $fillable = [
        'title',
        'montant',
    ];

    public function colocationUser()
    {
        return $this->belongsTo(ColocationUser::class);
    }
}

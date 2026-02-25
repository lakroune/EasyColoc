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
        'user_id',
        'colocation_id',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

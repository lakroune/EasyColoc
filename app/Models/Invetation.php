<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invetation extends Model
{

    protected $table = 'invetations';
    protected $fillable = [
        'colocation_id',
        'email',
        'token',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}

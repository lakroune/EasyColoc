<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColocationUser extends Model
{
    use HasFactory;
    protected $table = 'colocation_user';
    protected $fillable = [
        'colocation_id',
        'user_id',
        'role',
        'left_at',
    ];

    public function depences()
    {
        return $this->hasMany(Depense::class);
    }

}

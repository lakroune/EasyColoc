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
        'is_owner',
        'left_at',
    ];

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

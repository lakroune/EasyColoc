<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColocationUser extends Model
{
    //

    public function depences()
    {
        return $this->hasMany(Depense::class);
    }

}

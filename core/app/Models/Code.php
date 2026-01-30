<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'codes';
    
    public function redemptions()
    {
        return $this->hasMany(UserGiftCodeRedemption::class);
    }
    
}

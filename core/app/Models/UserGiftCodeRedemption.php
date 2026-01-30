<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGiftCodeRedemption extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'gift_code_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function giftCode()
    {
        return $this->belongsTo(Code::class);
    }
}
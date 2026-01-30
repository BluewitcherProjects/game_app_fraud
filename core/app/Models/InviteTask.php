<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteTask extends Model
{
    protected $fillable = ['referral_count', 'reward_amount'];
}

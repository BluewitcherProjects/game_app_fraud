<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;


    function getRoiAttribute(){


        $amount = $this->min_amount;
        $roi = ($amount * $this->interest_amount) / 100;


        //$return  = (1 + $roi) * $amount;

        //$perAnnuityInterest = ($amount * $this->interest_amount) / 100;
        //$return = $perAnnuityInterest * $this->total_return;

        $total = $roi + $amount;

        $return = $total;// / $this->total_return;

        return $return;

    }
}

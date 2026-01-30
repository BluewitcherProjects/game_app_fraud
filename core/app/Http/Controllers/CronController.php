<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Plan;
use App\Models\Admin;
use App\Models\Investment;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\GeneralSetting;
use App\Http\Services\TransferServices;

class CronController extends Controller
{


    public function cron(){


        //$all_pln


        /*$all_banks = getAllBanks();

        foreach ($all_banks['data'] as $bank){
            $b = new Bank();
            $b->bank_code = $bank['code'];
            $b->name = $bank['name'];
            $b->save();
        }*/
        //return $all_banks;

        try{

            $now = Carbon::now();
            $gnl = GeneralSetting::first();
            $gnl->last_cron = $now;
            $gnl->save();

            $investments = Investment::where('status', 0)  // Status: 0=>Running, 1=>Completed
                                         ->where('next_return_date', '<=', Carbon::now())
                                            ->with('user','plan')
                                         ->get();


            //return $investments;
            foreach($investments as $index => $data){
                $user = $data->user;
                $user->bonus_balance += $data->interest_amount;
                $user->total_earnings += $data->interest_amount;
                $user->save();


                $data->next_return_date = Carbon::now()->addHours($data->plan->interest_hours);
                $data->total_paid += 1;
                //$data->is_started = 0;

                if($data->total_paid >= $data->total_return){
                    $data->status = 1;
                }

                $data->save();

                $transaction = new Transaction();
                $transaction->user_id = $data->user_id;
                $transaction->amount = $data->interest_amount;
                $transaction->charge = 0;
                $transaction->post_balance = $user->balance;
                $transaction->trx_type = '+';
                $transaction->trx = getTrx();
                $transaction->details = 'Sold '.$data->plan->name;
                $transaction->save();

            }

        }catch(\Exception $ex){
            $admin = Admin::first();
            sendGeneralEmail($admin->email, $ex->getMessage(), $ex->getMessage(), '');
            \Log::error('CronController -> investment() line '. __LINE__ .': '.$ex->getMessage() ."\n");
        }


    }


    public function autopayout(){
        $withdrawals = Withdrawal::where('status',2)->with('user')->get();
        $pend_withdrawals = Withdrawal::where('status',2)->sum('amount');

        $transfer = new TransferServices();
        $balance = $transfer->fetchBalance();

        if ($balance > $pend_withdrawals) {

            foreach ($withdrawals as $withdraw) {
                $withdraw->status = 1;
                $confirm = new TransferServices();
                $confirm->initiate_transfer($withdraw->id);
                //$confirm->make_payment('100004','8168271947',$withdraw->charge,"NGN");
            }

        }




    }


}
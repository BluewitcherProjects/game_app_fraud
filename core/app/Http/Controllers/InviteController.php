<?php
namespace App\Http\Controllers;

use App\Models\InviteTask;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function invite(Request $request)
    {
        $user          = Auth::user();
        $amount        = $request->amount;
        $referralCount = $user->referrals()->whereHas('successfulDeposits')->count();

        $taskReward = InviteTask::where('reward_amount', $amount)->first();

        if (! $taskReward || $referralCount < $taskReward->referral_count) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'You are not eligible for this reward.',
            ], 200);
        }

        $alreadyClaimed = Task::where('user_id', $user->id)
            ->where('amount', $amount)
            ->exists();

        if ($alreadyClaimed) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'You already claimed this reward.',
            ], 200);
        }

        Task::create([
            'user_id' => $user->id,
            'amount'  => $amount,
        ]);

        $user->bonus_balance += $amount;
        $user->save();

        // Save transaction
        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $user->bonus_balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Invite Task Reward';
        $transaction->trx          = getTrx();
        $transaction->save();

        return response()->json([
            'status' => 'success',
            'msg'    => "You've claimed {$amount} successfully.",
        ]);
    }

    public function salary()
    {
        $pageTitle      = 'Invite Tasks';
        $user           = Auth::user();
        $referralsCount = $user->referrals()->whereHas('successfulDeposits')->count();
        $tasks          = InviteTask::orderBy('referral_count')->get();
        // Get amounts the user already claimed from the Task table
        $claimedAmounts = Task::where('user_id', $user->id)->pluck('amount')->toArray();
        return view($this->activeTemplate . 'user.salary', compact('pageTitle', 'referralsCount', 'tasks','claimedAmounts'));
    }
}

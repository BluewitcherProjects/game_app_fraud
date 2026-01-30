<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpinController extends Controller
{
    
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    
    public function spin(){
        $pageTitle = 'Spin Wheel';
        return view($this->activeTemplate . 'user.spin', compact('pageTitle'));
    }
    
    
    public function spinWheel(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $validated = $request->validate([
            'result' => 'required|string', // E.g., "R1", "Lost", "+5 Spin"
        ]);

        $result = $validated['result'];

        // Process the result
        switch ($result) {
            case 'R0':
                $bonus = 0;
                $user->bonus_balance += 0;
                break;
            case 'R1':
                $bonus = 1;
                $user->bonus_balance += 1;
                break;
            case 'R2':
                $bonus = 2;
                $user->bonus_balance += 2;
                break;
            case 'R3':
                $bonus = 3;
                $user->bonus_balance += 3;
                break;
            case 'R4':
                $bonus = 4;
                $user->bonus_balance += 4;
                break;
            case 'R5':
                $bonus = 5;
                $user->bonus_balance += 5;
                break;
            case '+5 Spin':
                $user->spin += 5;
                break;
            case 'Lost':
                $bonus = 0;
                $user->bonus_balance += 0;
                break;
            case 'R8':
                $bonus = 8;
                $user->bonus_balance += 8;
                break;
            case 'R20':
                $bonus = 20;
                $user->bonus_balance += 20;
                break;
            default:
                return response()->json(['error' => 'Invalid result'], 400);
        }

        // Deduct one spin
        // if ($result !== 'Lost') { 
        //     $user->spin -= 1;
        // }
        
        $user->spin -= 1;

        $user->save();
        
        $transaction = new Transaction(); 
        $transaction->user_id = $user->id;
        $transaction->amount = $bonus;
        $transaction->post_balance = $user->bonus_balance;
        $transaction->charge = 0;
        $transaction->trx_type = '+';
        $transaction->details = 'Spin Bonus';
        $transaction->trx =  getTrx();
        $transaction->save();

        return response()->json([
            'success' => true,
            'balance' => $user->bonus_balance,
            'spin' => $user->spin,
        ]);
    }
    
    
    public function checkSpin()
    {
        $user = Auth::user();
        return response()->json(['canSpin' => $user->spin > 0]);
    }
}

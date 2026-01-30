<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 09/02/2022
 * Time: 15:50
 */
?>
<style type="text/css">
    .copy-text{
        cursor: pointer;
    }
</style>
<div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Direct Deposit</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">

                    <h3 class="card-title text-center">
                        @if(auth()->user()->wallet)

                            <div style="word-break: break-word">
                                {{ auth()->user()->wallet->wallet_address }}
                            </div>

                            <div class="input-group">
                                <!-- Target -->
                                <input id="wallet_info_info" class="form-control" readonly value="{{ auth()->user()->wallet->wallet_address }}">

                                <span class="input-group-addon">
                                    <button class="btn btn-info btn-copy-wallet" data-clipboard-target="#wallet_info_info" >
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </span>

                            </div>

                            <p class="text-center">
                                Send USDT (TRC20) to your personal address. Your account will be credited immediately your payment is confirmed
                            </p>


                            <p class="text-danger">There is 1 USDT  charges on Direct Wallet Deposit</p>


                            <h6 class="text-center">Payment Calculator</h6>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Amount Sent</label>
                                    <input type="number" step="any" placeholder="Amount Sent" class="form-control" id="amount-sent">
                                </div>

                                <div class="form-group col-6">
                                    <label for="">Amount Credited</label>
                                    <input type="number" step="any" placeholder="Amount Credited" class="form-control" id="amount-credited">
                                </div>
                            </div>

                        @else
                            <p>
                                You do not have a personal deposit wallet
                            </p>

                            <form action="{{ route('user.wallet.create') }}" method="post">
                                <button type="submit" class="btn btn-info">Click Here to Create Wallet</button>
                            </form>
                        @endif
                    </h3>



                    <hr>

                </div>
            </div>
        </div>
    </div>
</div>

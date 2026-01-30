<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 09/02/2022
 * Time: 15:44
 */
?>
<div class="section wallet-card-section pt-1">
    <div class="wallet-card">
        <!-- Balance -->
        <div class="balance">
            <div class="left">
                <span class="title">Account Balance</span>
                <h1 class="total">{{$general->cur_sym}} {!! number_format(auth()->user()->balance) !!}</h1>
            </div>
            <div class="right">
                {{--<a href="{{ route('user.deposit') }}" class="btn btn-primary" >
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Deposit
                </a>--}}



                <a href="{{ route('user.deposit') }}"  class="btn btn-primary" >
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Recharge
                </a>
            </div>
        </div>


        <!-- * Balance -->
        <!-- Wallet Footer -->
        <div class="wallet-footer">
            <div class="item">
                <a href="{{ route('user.withdraw') }}">
                    <div class="icon-wrapper bg-danger">
                        <ion-icon name="arrow-down-outline"></ion-icon>
                    </div>
                    <strong>Withdraw</strong>
                </a>
            </div>
            <div class="item">
                <a href="{{ route('user.investment.log') }}" >
                    <div class="icon-wrapper">
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </div>
                    <strong>Products</strong>
                </a>
            </div>
            {{--<div class="item">
                <a href="{{ route('user.trades.copy.index') }}">
                    <div class="icon-wrapper bg-success">
                        <ion-icon name="card-outline"></ion-icon>
                    </div>
                    <strong>Copy Trade</strong>
                </a>
            </div>--}}
            <div class="item">
                <a href="{{ route('user.trx.log') }}" >
                    <div class="icon-wrapper bg-warning">
                        <ion-icon name="swap-vertical"></ion-icon>
                    </div>
                    <strong>Transaction</strong>
                </a>
            </div>

        </div>
        <!-- * Wallet Footer -->

        <div class="separator">
            <hr></div>
    </div>
</div>

<br><br>

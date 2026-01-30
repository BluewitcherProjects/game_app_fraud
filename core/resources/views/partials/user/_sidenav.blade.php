<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 09/02/2022
 * Time: 15:54
 */
?>
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- profile box -->
                <div class="profileBox pt-2 pb-2">
                    <div class="image-wrapper">

                    </div>
                    <div class="in">

                        <strong>{{ auth()->user()->name }}</strong>
                        {{--<div class="text-muted">{{ auth()->user()->account_code }}</div>--}}
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->
                <!-- balance -->
                <div class="sidebar-balance">
                    <div class="listview-title">Balance</div>
                    <div class="in">
                        <h1 class="amount">$ {!! getAmount(auth()->user()->balance) !!}</h1>
                    </div>
                </div>
                <!-- * balance -->

                <!-- action group -->
                <div class="action-group">
                    <a href="{{ route("user.deposit.history") }}" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="wallet"></ion-icon>
                            </div>
                            Deposit History
                        </div>
                    </a>
                    <a href="{{ route('user.transaction.log') }}" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="pricetag"></ion-icon>
                            </div>
                            Transactions
                        </div>
                    </a>
                    <a href="{{ route('user.game.log') }}" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            Trade Log
                        </div>
                    </a>
                </div>
                <!-- * action group -->

                <!-- menu -->


                <div class="listview-title mt-1">Practice Trades</div>
                <ul class="listview flush transparent no-line image-listview">

                    <li>
                        <a href="{{route('user.demo.play')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="caret-forward-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Practice Now
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.practice.trade.log')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Practice Log
                            </div>
                        </a>
                    </li>

                </ul>

                <div class="listview-title mt-1">Trades</div>
                <ul class="listview flush transparent no-line image-listview">

                    <li>
                        <a href="{{route('user.play.now')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="caret-forward-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Trade Now
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.wining.game.log')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Winning Trade
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.losing.game.log')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Losing Trade
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.draw.game.log')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Draw Trade
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('user.trades.copy.index') }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Copied Trades
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('user.trades.copy.traders') }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Copy New Trader
                            </div>
                        </a>
                    </li>

                </ul>
                <!-- * menu -->


                <div class="listview-title mt-1">Deposit</div>
                <ul class="listview flush transparent no-line image-listview">

                    {{--<li>
                        <a href="{{route('user.deposit')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Deposit Now
                            </div>
                        </a>
                    </li>--}}

                    <li>
                        <a href="{{route('user.deposit.history')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Deposit History
                            </div>
                        </a>
                    </li>

                </ul>

                <div class="listview-title mt-1">Withdrawal</div>
                <ul class="listview flush transparent no-line image-listview">

                    <li>
                        <a href="{{route('user.withdraw')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Withdraw Now
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.withdraw.history')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="folder-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Withdrawal History
                            </div>
                        </a>
                    </li>

                </ul>


                <div class="listview-title mt-1">Referral</div>
                <ul class="listview flush transparent no-line image-listview">

                    <li>
                        <a href="{{route('user.referralog.log')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="people-outline"></ion-icon>
                            </div>
                            <div class="in">
                                My Referrals
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('user.teams')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="people-outline"></ion-icon>
                            </div>
                            <div class="in">
                                My Teams
                            </div>
                        </a>
                    </li>


                    <li>
                        <a href="{{route('user.commissions.log')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Commissions Logs
                            </div>
                        </a>
                    </li>

                </ul>

                <!-- others -->
                <div class="listview-title mt-1">Others</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="{{ route('user.transaction.log') }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="stats-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Transactions
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route("user.profile-setting") }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Profile Update
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route("user.change-password") }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="lock-open-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Update Password
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route("user.twofactor") }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="key-outline"></ion-icon>
                            </div>
                            <div class="in">
                                2FA Security
                            </div>
                        </a>
                    </li>




                    <li>
                        <a href="{{route('user.logout')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Log out
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * others -->


            </div>
        </div>
    </div>
</div>

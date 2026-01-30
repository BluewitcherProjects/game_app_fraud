<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 09/02/2022
 * Time: 22:18
 */
?>
<div class="section mt-4 mb-4">
    <div class="section-heading">
        <h2 class="title">Recent Transactions</h2>
        <a href="{{ route('user.transactions') }}" class="link">View All</a>
    </div>

    @include("users.dashboard._transactions")
</div>

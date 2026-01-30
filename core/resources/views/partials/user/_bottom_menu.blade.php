<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 09/02/2022
 * Time: 15:53
 */
?>
<style>
    .active>a{
        color: #6305b1 !important;
    }
</style>



<div class="bottom_nav main_Wrap">
    <ul>
        <li class="{{ menuActive('user.home') }}">
            <a href="{{ route('user.home') }}"><i class="fa fa-home"></i>Home</a>
        </li>
        <li class="{{ menuActive('user.investment') }}">
            <a href="{{ route('user.investment') }}"><i class="fa fa-shopping-cart"></i>Products</a>
        </li>
        <li class="{{ menuActive('user.link') }}">
            <a href="{{ route('user.link') }}"><i class="fa fa-qrcode"></i>Invite</a>
        </li>
        <li class="{{ menuActive('user.profile.setting') }}">
            <a href="{{ route('user.profile.setting') }}"><i class="fa fa-user-circle-o"></i>Me</a>
        </li>
    </ul>
</div>

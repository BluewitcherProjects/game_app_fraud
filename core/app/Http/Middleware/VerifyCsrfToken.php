<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;



class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'shpay/ipn',
        '/shpay/ipn',
        '/shpay/withdraw/ipn',
        'shpay/withdraw/ipn',
        'flutterwave/ipn',
        '/flutterwave/ipn',
        'user/deposit',
        'ipn*'
    ];
}
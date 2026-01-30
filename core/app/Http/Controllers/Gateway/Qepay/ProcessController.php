<?php

namespace App\Http\Controllers\Gateway\Qepay;

use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Carbon\Carbon;

class ProcessController extends Controller
{
    public static function process($deposit)
    {
        $gateway = $deposit->gateway;
        $gatewayParams = json_decode($gateway->gateway_parameters);

        $merchant_key = $gatewayParams->depositKey->value;
        $mch_id = $gatewayParams->mchtId->value;

        $version = "1.0";
        $notify_url = route('shpay');
        $page_url = route('shpay.return');
        $mch_order_no = $deposit->trx;
        $pay_type = "101";
        $trade_amount = "" . round($deposit->final_amo, 2) . "";
        $order_date = Carbon::now()->format('Y-m-d H:i:s');
        $bank_code = "";
        $goods_name = "plan";
        $sign_type = "MD5";
        $mch_return_msg = "";

        $signStr = "";
        if ($bank_code != "") {
            $signStr = $signStr . "bank_code=" . $bank_code . "&";
        }
        $signStr = $signStr . "goods_name=" . $goods_name . "&";
        $signStr = $signStr . "mch_id=" . $mch_id . "&";
        $signStr = $signStr . "mch_order_no=" . $mch_order_no . "&";
        if ($mch_return_msg != "") {
            $signStr = $signStr . "mch_return_msg=" . $mch_return_msg . "&";
        }
        $signStr = $signStr . "notify_url=" . $notify_url . "&";
        $signStr = $signStr . "order_date=" . $order_date . "&";
        if ($page_url != "") {
            $signStr = $signStr . "page_url=" . $page_url . "&";
        }
        $signStr = $signStr . "pay_type=" . $pay_type . "&";
        $signStr = $signStr . "trade_amount=" . $trade_amount . "&";
        $signStr = $signStr . "version=" . $version;

        $sign = PaymentController::sign($signStr, $merchant_key);

        $postdata = array(
            'goods_name' => $goods_name,
            'mch_id' => $mch_id,
            'mch_order_no' => $mch_order_no,
            'notify_url' => $notify_url,
            'order_date' => $order_date,
            'pay_type' => $pay_type,
            'trade_amount' => $trade_amount,
            'version' => $version,
            'page_url' => $page_url,
            'sign_type' => $sign_type,
            'sign' => $sign,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.watchglb.com/pay/web");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        \Log::info('WatchPay Deposit Request', ['postdata' => $postdata, 'signStr' => $signStr]);
        \Log::info('WatchPay Deposit Response', ['response' => $response, 'curl_error' => $curlError]);

        $result = json_decode($response, true);

        if (isset($result['tradeResult']) && $result['tradeResult'] == 1) {
            $deposit->status = 2;
            $deposit->save();

            $send['redirect'] = true;
            $send['redirect_url'] = $result['payInfo'];
        } else {
            $send['error'] = true;
            $send['message'] = $result['msg'] ?? 'Payment gateway error';
        }

        return json_encode($send);
    }

    public function ipn()
    {
        // IPN is handled by PaymentController@shpayipn
    }
}

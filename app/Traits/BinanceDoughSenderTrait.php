<?php

namespace App\Traits;

use App\Models\Provider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait BinanceDoughSenderTrait {
    public static function send($amount, $destinationAccount) {
        try {
            $db_key = Provider::where('key','API GENERAL BINANCE PAY')->first();
            $apiKey = Crypt::decryptString($db_key->value);
            $secretKey = Crypt::decryptString($db_key->secret_key);

            $nonce = Str::random(32);
            $merchantSendId = Str::random(32);

            $transferDetailList = [
                [
                    'merchantSendId'     => $merchantSendId,
                    'receiveType'        => "BINANCE_ID",
                    'receiver'           => $destinationAccount,
                    'transferAmount'     => $amount,
                    'transferMethod'     => "SPOT_WALLET",
                ]
            ];

            $timestamp = Carbon::now()->isoFormat('x');

            $body = [
                'requestId'           => "testing12345",
                'batchName'           => "testing transfers",
                'currency'            => "BUSD",
                'totalAmount'         => $amount,
                'totalNumber'         => 1,
                'transferDetailList'  => $transferDetailList,
            ];

            $payload = $timestamp."\n".$nonce."\n".json_encode($body)."\n";
            $signature = strtoupper(hash_hmac('sha512', $payload, $secretKey));

            $response = Http::accept('application/json')
            ->withHeaders([
                'BinancePay-Timestamp'       => $timestamp,
                'BinancePay-Nonce'           => $nonce,
                'BinancePay-Certificate-SN'  => $apiKey,
                'BinancePay-Signature'       => $signature
            ])
            ->post('https://bpay.binanceapi.com/binancepay/openapi/payout/transfer', $body);

            return json_decode($response);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

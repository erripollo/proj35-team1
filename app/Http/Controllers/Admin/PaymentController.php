<?php

namespace App\Http\Controllers\Admin;

use Braintree;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Sponsor;

class PaymentController extends Controller
{
    public function checkout(Request $request, Apartment $apartment)
    {
        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '9fmq8tsssr44vd6w',
            'publicKey' => 's5gktwjfckwb2ftg',
            'privateKey' => '251dbb6fe39dd6de17313a138ee24cab',
        ]);

        $amount = $request->amount;
        // $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            date_default_timezone_set('Europe/Rome');
            $date = date("Y-m-d H:i:s");
            $sponsor = Sponsor::all()->where('price', $request->amount)->first();
            $sponId = $sponsor->id;
            $thedate = strtotime($date . ' + ' . $sponsor->period . 'hour');
            $expirationDate = date('Y-m-d H:i:s', $thedate);
            $apartment->sponsors()->attach($sponId, ['end' => $expirationDate]);
            return back()->with('success_message', 'Il pagamento è  avvenuto con successo.');
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Ops, c\'è stato un errore durante il pagamento. Riprova.');
        }
    }
}

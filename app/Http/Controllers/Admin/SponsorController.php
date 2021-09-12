<?php

namespace App\Http\Controllers\Admin;

use Braintree;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Sponsor;

class SponsorController extends Controller
{
    public function buySponsorship(Apartment $apartment)
    {
        $sponsors = Sponsor::all();
        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '9fmq8tsssr44vd6w',
            'publicKey' => 's5gktwjfckwb2ftg',
            'privateKey' => '251dbb6fe39dd6de17313a138ee24cab',

        ]);

        $token = $gateway->ClientToken()->generate();


        return view('admin.sponsors', compact('apartment', 'sponsors', 'token'));
    }
}

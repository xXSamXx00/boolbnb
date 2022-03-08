<?php

namespace App\Http\Controllers\Registered;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsor;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        $sponsors = Sponsor::all();

        return view('registered.sponsors.index', compact('sponsors', 'apartment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment, Sponsor $sponsor, Gateway $gateway)
    {
        // ddd($sponsor);
        $token = $gateway->ClientToken()->generate();

        return view('registered.sponsors.show', compact('sponsor', 'token', 'apartment'));
    }

    public function checkout(Apartment $apartment, Sponsor $sponsor, Gateway $gateway)
    {

        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;



            // ddd($pivot);
            $start_date = Carbon::now('Europe/Rome');
            $end_date = $start_date->addHours($sponsor->duration)->format('Y-m-d H:i:s');

            // ddd($start_date, $end_date);

            $data = [
                'apartment_id' => $apartment->id,
                'sponsor_id' => $sponsor->id,
                'start_date' => $transaction->createdAt,
                'end_date' => $end_date, //aggiungere la data di scadenza
            ];

            DB::table('apartment_sponsor')->insert($data);


            return redirect()->route('registered.apartments.index')->with('message', "Transazione avvenuta con successo! L'ID della transazione è: $transaction->id");
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Transazione fallita! Il motivo è: ' . $result->message);
        }
    }
}
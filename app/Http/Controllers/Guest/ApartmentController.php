<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments  = Apartment::where('visibility', true)->orderByDesc('id')->paginate(12);
        $today = Carbon::now('Europe/Rome');
        $check_if_home = true;
        return view('guest.apartments.index', compact('apartments', 'today', 'check_if_home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->visibility || Auth::id() === $apartment->user_id) {
            $clientIP = request()->ip();
            $validate = [
                'ip_address' => $clientIP,
                'apartment_id' => $apartment->id,
            ];

            View::create($validate);
            return view('guest.apartments.show', compact('apartment'));
        } else {
            abort(403);
        }
    }
}
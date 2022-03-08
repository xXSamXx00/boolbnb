<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=> 'nullable|max:50',
            'email' => 'required|email',
            'message' => 'required|min:5|max:1500',
            'apartment_id' => 'required',
            'oggetto_mail' => 'required',
            'slug' => 'required',
        ]);
        Contact::create($validated);
        return redirect()->route('guest.apartments.show', $validated['slug'] )->with('message', 'messaggio inviato');
    }
}

@extends('layouts.registered')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <h1>Dettaglio messaggio</h1>
            <hr>
            <div class="col-md-6 messages mx-auto">
                <p class="fs-4 pb-2">Messaggio inviato da {{ $contact->email }}, {{ $contact->name }} </p>
                <p class="border-bottom border-secondary border-3 pb-2"><span class="fw-bold">Oggetto:</span> {{ $contact->oggetto_mail }}</p>
                 <p><span class="fw-bold">Messaggio:</span> <br>
                   {{ $contact->message }}
                  </p>
              <p><span class="fw-bold">Data:</span> {{ $contact->created_at }} </p>
               </div>
            </div>


    </div>

@endsection

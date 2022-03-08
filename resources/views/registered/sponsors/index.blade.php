@extends('layouts.registered')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center py-4 title_sponsor fw-bold">Sponsor</h1>
        <div class="row">
            <p class="fs-4 mb-4 text-center desc_sponsor">Sponsorizza il tuo appartamento affinchè venga mostrato prima degli
                altri, <br> scegliendo
                uno dei seguenti
                pacchetti:</p>
            @foreach ($sponsors as $sponsor)
                <div class="col-sm my-4">
                    <div class="card card_sponsor justify-content-center align-items-center rounded-3 p-3">
                        <h2 class="text-center sponsor_name">{{ $sponsor->name }}</h2>
                        <div class="card-body text-center border-top">
                            <p class="fs-4 text-center">Prezzo: <span class="fs-2 fw-bold price">{{ $sponsor->price }}€</span></p>
                            <p class="fs-5 text-center">Durata sponsorizzazione: {{ $sponsor->duration }} ore</p>
                            <a class="btn btn-orange text-white text-center"
                                href="{{ route('registered.sponsors.show', ['apartment' => $apartment->id, 'sponsor' => $sponsor->id]) }}">
                                Acquista ora
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('navbar')
@include('partials.adv')
@endsection

@section('content')
    <div class="my-5 container">
        <h2 class="mb-3">{{ $apartment->title }}</h2>
        <p class="fs-6 fw-bold place"><i class="fa-solid fa-location-dot"></i> {{ $apartment->address }}.</p>
        <div class="row">
            <div class="col-12 col-xl-6">
                <div>
                    <img class="rounded-start" width="100%" src="{{ asset('storage/' . $apartment->image) }}"
                        alt="Immagine appartamento">
                </div>

                <!---------dettagli appartamento bagni, camere, mq, letti --------->
                <div class='my-5'>
                    <span class="badge p-2 me-3 back_icon"><i class="fa-solid fa-person-booth icon_show"></i> <span class="text_service">{{ $apartment->n_rooms }}</span></span>
                    <span class="badge p-2 me-3 back_icon"><i class="fa-solid fa-bed icon_show"></i> <span class="text_service"> {{ $apartment->n_bed }}</span></span>
                    <span class="badge p-2 me-3 back_icon"><i class="fa-solid fa-expand icon_show"></i> <span class="text_service"> {{ $apartment->square_meters }}
                        mq</span></span>
                    <span class="badge p-2 me-3 back_icon"><i class="fa-solid fa-toilet icon_show"></i> <span class="text_service"> {{ $apartment->n_bathroom }}</span></span>

                    <!--------- servizi --------->
                    <p class="my-3"> Servizi disponibili:
                        @forelse ($apartment->services as $service)
                            <div class="badge mb-2 p-2 me-3 text-black bg-icon ">
                                <span>
                                    <img class="mx-2" height="20"
                                        src="{{ asset('img/service_logo/' . $service->icon . '.svg') }}"
                                        alt="{{ $service->name }}">
                                </span>
                                <span class="service_text">
                                    {{ $service->name }}
                                </span>

                            </div>
                        @empty
                            Nessun servizio aggiuntivo
                        @endforelse

                    </p>
                    <!--------------------------->
                </div>
            </div>
            <!---- descrizione appartamento ----->
            <div class="col-12 col-xl-6">
                @if ($apartment->description)
                    @if (strlen($apartment->description) > 2100)
                        <p class="apartment_description">{{ substr($apartment->description, 0, 2100) . '...' }}
                            <a type="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#showMore">Mostra
                                altro</a>
                        </p>

                        <!-- Modal -->
                        <div class="modal fade" id="showMore" tabindex="-1" role="dialog"
                            aria-labelledby="modal_{{ $apartment->id }}" aria-hidden="true">
                            <div class="modal-dialog col-4 col-md-12" style="max-width: 800px!important;" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Descrizione Completa
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        {{ $apartment->description }}
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn bg_primary text-white" data-bs-dismiss="modal"
                                            value="OK">
                                    </div>
                                </div>
                            </div>
                        </div>


                    @else
                        <p class="apartment_description">{{ $apartment->description }}</p>
                    @endif
                @else
                    <p>Nessuna descrizione.</p>
                @endif
            </div>
            <!--------------------------->


            <!-------------  Mappa    ----------->
            <div class="map_container container">
                <map-component :apartment='{{ json_encode($apartment) }}'></map-component>
            </div>
            <!--------------------------->
        </div>

        <div class="message_container container">
            <div class="row mb-5 bg_primary p-3">
                <h3 class="text-white">Contatta il proprietario</h3>

                <!-------------- form per contattare il proprietario dell'annuncio --------------------------->
                <form action="{{ route('guest.contacts.store') }}" method='post'>
                    @csrf
                    <div class="mb-3">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="name" class="form-label"></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Come ti chiami?" required minleght='4' maxlenght='50'
                                    aria-describedby="nameHelper" value="{{ old('name') }}">
                                <small id="helpId" class="text-white">Inserisci il tuo nome e cognome</small>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label"></label>
                                @auth
                                    <input type="email" name="email" id="email" class="form-control" required
                                        aria-describedby="emailHelper" value="{{ Auth::user()->email }}">
                                @else
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="email@example.com" required aria-describedby="emailHelper"
                                        value="{{ old('email') }}">
                                @endauth
                                <small id="helpId" class="text-white">Inserici la tua mail</small>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class='d-none'>
                                <label for="apartment_id" class="form-label"></label>
                                <input type="apartment_id" name="apartment_id" id="apartment_id" class="form-control"
                                    value="{{ $apartment->id }}">
                            </div>

                            <div class='d-none'>
                                <label for="slug" class="form-label"></label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ $apartment->slug }}">
                            </div>

                            <div class='d-none'>
                                <label for="oggetto_mail" class="form-label"></label>
                                <input type="text" name="oggetto_mail" id="oggetto_mail" class="form-control"
                                    value="{{ $apartment->title }}">
                            </div>
                        </div>

                        <div class="col">
                            <textarea class="form-control" name="message" required id="message" rows="3"
                                placeholder="Inserisci il messaggio">{{ old('message') }}</textarea>
                            <small id="message" class="text-white">Inserisci il tuo messaggio al proprietario
                                dell'appartamento</small>
                            @error('message')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-light">Invia</button>
                        </div>
                    </div>
                </form>
                <!-------------------------------------------------------------------------------------------->
            </div>
        </div>
    </div>
@endsection

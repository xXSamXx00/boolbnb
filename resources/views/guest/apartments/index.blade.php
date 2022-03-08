@extends('layouts.app')

@section('navbar')
    @include('partials.guestNavbar')
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center hero_image">

        <searchbar-component :check_if_home='{{ $check_if_home }}'></searchbar-component>
    </div>
    <div class="container ">
        <h1 class="text-center mt-5 font_style fw-bold color_text">Sponsorizzati</h1>
        <div class="row sponsorized justify-content-center flex-wrap py-5">
            @foreach ($apartments as $apartment)
                @foreach ($apartment->sponsors as $sponsor)
                    @if (strtotime($sponsor->pivot->end_date) > strtotime($today))
                        <div class="col-12 col-sm-12 col-md-6 col-xl-4">
                            <div class="card justify-content-between card_promo m-3">
                                <a href="{{ route('guest.apartments.show', $apartment->slug) }}">
                                    <img class="card-img-top thumb" src="{{ asset('storage/' . $apartment->image) }}"
                                        alt="Card image cap">
                                </a>
                                <p class="promo">Sponsorized</p>

                                <h2 class="card-text m-3 card_title">{{ $apartment->title }}</h2>
                                <div class="box">
                                    <p class="card-text m-3">{{ $apartment->description }}</p>
                                </div>

                                <h6 class="mx-3 service">Services</h6>
                                <div class="services mx-3 d-flex flex-wrap">
                                    <!-- -------------------------- -->
                                    @foreach ($apartment->services as $service)
                                        <!-- ****** -->
                                        <div class="card_apart">
                                            <div class="label_card p-1 me-1 align-items-center d-flex mb-2">
                                                <img class="mx-2" height="20"
                                                    src="../img/service_logo/{{ $service->icon }}.svg"
                                                    alt="{{ $service->name }}">
                                                {{-- <span class="mx-2 icon_name">{{ $service->name }}</span> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- -------------------------- -->
                                </div>

                                <div
                                    class="button_details p-2 w-50 justify-content-center align-items-center text-center text-white m-auto mt-4 mb-4">
                                    <span><a href="{{ route('guest.apartments.show', $apartment->slug) }}">View
                                            details</a></span>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach

        </div>
        <h1 class="text-center font_style fw-bold">Appartamenti</h1>
        <div class="row justify-content-center flex-wrap py-5">

            @forelse ($apartments as $apartment)
                <div class="col-12 col-sm-12 col-md-6 col-xl-4">
                    <div class="card justify-content-between card_promo m-3 ">
                        <a href="{{ route('guest.apartments.show', $apartment->slug) }}">
                            <img class="card-img-top thumb" src="{{ asset('storage/' . $apartment->image) }}"
                                alt="Card image cap">
                        </a>
                        @foreach ($apartment->sponsors as $sponsor)
                            @if (strtotime($sponsor->pivot->end_date) > strtotime($today))
                                <p class="promo">Sponsorized</p>
                            @endif
                        @endforeach
                        <h2 class="card-text m-3 card_title">{{ $apartment->title }}</h2>
                        <div class="box">
                            <p class="card-text m-3">{{ $apartment->description }}</p>
                        </div>

                        <h6 class="mx-3 service">Services</h6>
                        <div class="services mx-3 d-flex flex-wrap">
                            <!-- -------------------------- -->
                            @foreach ($apartment->services as $service)
                                <!-- ****** -->
                                <div class="card_apart">
                                    <div class="label_card p-1 me-1 align-items-center d-flex flex-column mb-2">
                                        <img class="mx-2" height="20"
                                            src="../img/service_logo/{{ $service->icon }}.svg"
                                            alt="{{ $service->name }}">
                                        {{-- <span class="mx-2 icon_name">{{ $service->name }}</span> --}}
                                    </div>
                                </div>
                            @endforeach
                            <!-- -------------------------- -->
                        </div>
                        <div
                            class="button_details p-2 w-50 justify-content-center align-items-center text-center text-white m-auto mt-4 mb-4">
                            <span><a href="{{ route('guest.apartments.show', $apartment->slug) }}">View
                                    details</a></span>
                        </div>

                    </div>

                </div>

            @empty
                <p>no data</p>
            @endforelse
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        {{ $apartments->links() }}
    </div>
@endsection

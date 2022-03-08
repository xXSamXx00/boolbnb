@extends('layouts.app')

@section('navbar')
@include('partials.adv')
@endsection

@section('content')
    <div class="justify-content-center">
        <div class="bg_search pt-3">
            <div class="font_style text-center">
            <h3 class="fw-bold text-white">Cerca per Città o Indirizzo</h3>
        </div>
        <searchbar-component></searchbar-component>
        </div>

        <advanced-search :services='{{ json_encode($services) }}'>
        </advanced-search>

    </div>
@endsection

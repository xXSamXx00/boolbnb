@extends('layouts.registered')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="container">
        <div class="row justify-content-around">


            <div class="col-3">
                <dashboard-graph :apartments_online='{{ json_encode($apartments_online) }}'
                    :apartments_offline='{{ json_encode($apartments_offline) }}'></dashboard-graph>
            </div>

            <div class="col-3">
                <div class="card text-center" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Inserisci un appartamento</h5>
                        <a class="btn bg_orange text-white py-2 px-4" href="{{ route('registered.apartments.create') }}"
                            role="button">
                            <i class="fa-regular fa-plus fa-3x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

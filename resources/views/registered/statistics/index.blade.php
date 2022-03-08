@extends('layouts.registered')

@section('content')

    <div class="container mt-3">
        <h2>Statistiche dell'appartamento: {{ $apartment->title }}</h2>
        <hr>
        <div class='mt-5 mx-auto w-50'>
            <div class="table-responsive-lg">
                <table class="table table-dark table-hover table-borderless table-striped table-sm">
                    <thead>
                        <tr>
                            <th  class='text-center'>Periodo</th>
                            <th  class='text-center'>n° Visualizzazioni</th>
                            <th  class='text-center'>n° Messaggi ricevuti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data[0] as $key0 => $index0)
                        @foreach ($index0 as $key1 => $index1)
                        @foreach ($index1 as $key2 => $index2)
                            <tr>
                                <td class='text-center'>{{$key2}} / 20{{$key1}}</td>
                                <td class='text-center'>
                                    @if(count($index2) != 0)
                                    {{count($index2)}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class='text-center'>
                                    @if(isset($data[1][$key0][$key1][$key2]) && count($data[1][$key0][$key1][$key2]) != 0)
                                    {{count($data[1][$key0][$key1][$key2])}}
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


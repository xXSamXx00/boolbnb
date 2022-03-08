<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        /* $aparts = Apartment::with(['services'])

            ->where('address', 'like', "%" . request('address') . "%")
            ->where('n_rooms', '>', intval(request('n_rooms')))
            ->where('n_bathroom', '>', intval(request('n_bathroom')))
            ->get();
        return ApartmentResource::collection($aparts); */

        //return ApartmentResource::collection(Apartment::with(['services'])->paginate(20));

        //////////////////////////////////////////////////////////////////////////////////////////////

        //Alternative  Giuseppe method

        //$requestQuery = $request->query();
        $reqServices = explode(',', $request->services);
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        //$distance = $request->distance;

        if ($request->distance < 20) {
            $distance = 20;
        } else
            $distance = $request->distance;

        if ($request->n_bed < 1) {
            $n_bed = 1;
        } else
            $n_bed = $request->n_bed;

        if ($request->n_rooms < 1) {
            $n_rooms = 1;
        } else
            $n_rooms = $request->n_rooms;



        /* funzione per calcolare la distanza */



        //$aparts = Apartment::all();
        $aparts = Apartment::where('visibility', true)
            ->where('n_bed', '>=', $n_bed)
            ->where('n_rooms', '>=', $n_rooms)
            ->get();


        if (!empty($request->services)) {
            $aparts = Apartment::where('visibility', true)
                ->where('n_bed', '>=', $n_bed)
                ->where('n_rooms', '>=', $n_rooms)
                ->whereHas('services', function ($param) use ($reqServices) {
                    $param->WhereIn('service_id', $reqServices);
                })->get();
        }


        function calcDist($lat1, $lon1, $lat2, $lon2)
        {
            $distance = (3958 * 3.1415926 * sqrt(($lat2 - $lat1) * ($lat2 - $lat1) + cos($lat2 / 57.29578) * cos($lat1 / 57.29578) * ($lon2 - $lon1) * ($lon2 - $lon1)) / 180);
            return $distance * 1.852; //Converto miglia in chilometri
        };
        /* condizione per la distanza */
        if ($request->latitude != null && $request->longitude != null) {
            $filterByDistance = [];
            foreach ($aparts as $apartment) {
                $distanceApartment = calcDist($latitude, $longitude, $apartment->latitude, $apartment->longitude);

                if ($distanceApartment < $distance || ($latitude === null && $longitude === null)) {
                    $filterByDistance[] = $apartment;
                    //$filterByDistance[] = [$distanceApartment => $apartment];
                }
            }
            //$sortFilterDistance = array_multisort($filterByDistance);
            //ddd($sortFilterDistance);
            //ddd($filterByDistance);
        }

        return ApartmentResource::collection($filterByDistance);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
        return new ApartmentResource(Apartment::find($apartment->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
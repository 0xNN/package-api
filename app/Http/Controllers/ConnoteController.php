<?php

namespace App\Http\Controllers;

use App\Models\Connote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ConnoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(),[
            'connote_id' => 'required|unique:connote|max:36',
            'connote_number' => 'required|numeric',
            'connote_service' => 'required',
            'connote_service_price' => 'required|numeric',
            'connote_amount' => 'required|numeric',
            'connote_code' => 'required',
            'connote_order' => 'required|numeric',
            'connote_state' => 'required',
            'connote_state_id' => 'required|numeric',
            'zone_code_from' => 'required',
            'zone_code_to' => 'required',
            'transaction_id' => 'required|max:36',
            'actual_weight' => 'required|numeric',
            'volume_weight' => 'required|numeric',
            'chargeable_weight' => 'required|numeric',
            'organization_id' => 'required|numeric',
            'location_id' => 'required',
            'connote_total_package' => 'required',
            'connote_surcharge_amount' => 'required',
            'connote_sla_day' => 'required',
            'location_name' => 'required',
            'location_type' => 'required',
            'source_tariff_db' => 'required',
            'id_source_tariff' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        try {
            $connote = new Connote;
            $connote->connote_id = $request->connote_id;
            $connote->connote_number = $request->connote_number;
            $connote->connote_service = $request->connote_service;
            $connote->connote_service_price = $request->connote_service_price;
            $connote->connote_amount = $request->connote_amount;
            $connote->connote_code = $request->connote_code;
            $connote->connote_booking_code = $request->connote_booking_code;
            $connote->connote_order = $request->connote_order;
            $connote->connote_state = $request->connote_state;
            $connote->connote_state_id = $request->connote_state_id;
            $connote->zone_code_from = $request->zone_code_from;
            $connote->zone_code_to = $request->zone_code_to;
            $connote->surcharge_amount = $request->surcharge_amount;
            $connote->transaction_id = $request->transaction_id;
            $connote->actual_weight = $request->actual_weight;
            $connote->volume_weight = $request->volume_weight;
            $connote->chargeable_weight = $request->chargeable_weight;
            $connote->organization_id = $request->organization_id;
            $connote->location_id = $request->location_id;
            $connote->connote_total_package = $request->connote;
            $connote->connote_surcharge_amount = $request->connote;
            $connote->connote_sla_day = $request->connote;
            $connote->location_name = $request->location_name;
            $connote->location_type = $request->location_type;
            $connote->source_tariff_db = $request->source_tariff_db;
            $connote->id_source_tariff = $request->id_source_tariff;
            $connote->pod = $request->pod;
            $connote->history = $request->history;
            $connote->save();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            return response()->json($ex->getMessage(), 409);
        }
        
        if($connote) {
            return response()->json([
                'data'=>$connote,
                'response'=>'true',
                'message'=>'success',
                'code'=>'200'
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Connote  $connote
     * @return \Illuminate\Http\Response
     */
    public function show(Connote $connote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Connote  $connote
     * @return \Illuminate\Http\Response
     */
    public function edit(Connote $connote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Connote  $connote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Connote $connote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Connote  $connote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Connote $connote)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Koli;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = TransactionResource::collection(Transaction::all());
        return response()->json($transaction);
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
            'transaction_id' => 'required|unique:transactions|max:36',
            'customer_name' => 'required',
            'customer_code' => 'required',
            'transaction_amount' => 'required',
            'transaction_discount' => 'required',
            'transaction_additional_field' => 'required',
            'transaction_payment_type' => 'required',
            'transaction_state' => 'required',
            'transaction_code' => 'required|unique:transactions|max:16',
            'transaction_order' => 'required|numeric',
            'location_id' => 'required|max:24',
            'organization_id' => 'required|numeric',
            'transaction_payment_type_name' => 'required',
            'transaction_cash_amount' => 'required|numeric',
            'transaction_cash_change' => 'required|numeric',
            'Nama_Sales' => 'required|string',
            'TOP' => 'required',
            'Jenis_Pelanggan' => 'required',
            'connote_id' => 'required|unique:transactions|max:36',
            'connote_number' => 'required|numeric',
            'connote_service' => 'required',
            'connote_service_price' => 'required|numeric',
            'connote_amount' => 'required|numeric',
            'connote_code' => 'required',
            'connote_order' => 'required|numeric',
            'connote_state' => 'required',
            'zone_code_from' => 'required',
            'zone_code_to' => 'required',
            'actual_weight' => 'required|numeric',
            'volume_weight' => 'required|numeric',
            'chargeable_weight' => 'required|numeric',
            'connote_total_package' => 'required',
            'connote_surcharge_amount' => 'required',
            'connote_sla_day' => 'required',
            'location_name' => 'required',
            'location_type' => 'required',
            'source_tariff_db' => 'required',
            'id_source_tariff' => 'required',
            'customer_name_origin' => 'required|string',
            'customer_address_origin' => 'required',
            'customer_phone_origin' => 'required',
            'customer_zip_code_origin' => 'required',
            'zone_code_origin' => 'required',
            'organization_id_origin' => 'required|numeric',
            'location_id_origin' => 'required',
            'customer_name_destination' => 'required|string',
            'customer_address_destination' => 'required',
            'customer_phone_destination' => 'required',
            'customer_zip_code_destination' => 'required',
            'zone_code_destination' => 'required',
            'organization_id_destination' => 'required|numeric',
            'location_id_destination' => 'required',
            'location_name' => 'required',
            'location_code' => 'required',
            'location_type' => 'required'
        ]);

        $kolis = Koli::where('connote_id', $request->connote_id)->get();

        $transaction = new Transaction;
        $transaction->transaction_id = $request->transaction_id;
        $transaction->customer_name = $request->customer_name;
        $transaction->customer_code = $request->customer_code;
        $transaction->transaction_amount = $request->transaction_amount;
        $transaction->transaction_discount = $request->transaction_discount;
        $transaction->transaction_additional_field = $request->transaction_additional_field;
        $transaction->transaction_payment_type = $request->transaction_payment_type;
        $transaction->transaction_state = $request->transaction_state;
        $transaction->transaction_code = $request->transaction_code;
        $transaction->transaction_order = $request->transaction_order;
        $transaction->location_id = $request->location_id;
        $transaction->organization_id = $request->organization_id;
        $transaction->transaction_payment_type_name = $request->transaction_payment_type_name;
        $transaction->transaction_cash_amount = $request->transaction_cash_amount;
        $transaction->transaction_cash_change = $request->transaction_cash_change;
        $transaction->customer_attribute = [
            'Nama_Sales' => $request->Nama_Sales,
            'TOP' => $request->TOP,
            'Jenis_Pelanggan' => $request->Jenis_Pelanggan,
        ];
        $transaction->connote = [
            'connote_id' => $request->connote_id,
            'connote_number' => $request->connote_number,
            'connote_service' => $request->connote_service,
            'connote_service_price' => $request->connote_service_price,
            'connote_amount' => $request->connote_amount,
            'connote_code' => $request->connote_code,
            'connote_booking_code' => $request->connote_booking_code,
            'connote_order' => $request->connote_order,
            'connote_state' => $request->connote_state,
            'connote_state_id' => $request->connote_state_id,
            'zone_code_from' => $request->zone_code_from,
            'zone_code_to' => $request->zone_code_to,
            'surcharge_amount' => $request->surcharge_amount,
            'transaction_id' => $request->transaction_id,
            'actual_weight' => $request->actual_weight,
            'voluem_weight' => $request->volume_weight,
            'chargeable_weight' => $request->chargeable_weight,
            'organization_id' => $request->organization_id,
            'location_id' => $request->location_id,
            'connote_total_package' => $request->connote_total_package,
            'connote_surcharge_amount' => $request->connote_surcharge_amount,
            'connote_sla_day' => $request->connote_sla_day,
            'location_name' => $request->location_name,
            'location_type' => $request->location_type,
            'source_tariff_db' => $request->source_tariff_db,
            'id_source_tariff' => $request->id_source_tariff,
            'pod' => $request->pod,
            'history' => [$request->history],
        ];
        $transaction->connote_id = $request->connote_id;
        $transaction->origin_data = [
            "customer_name" => $request->customer_name_origin,
            "customer_address" => $request->customer_address_origin,
            "customer_email" => $request->customer_email_origin,
            "customer_phone" => $request->customer_phone_origin,
            "customer_address_detail" => $request->customer_address_detail_origin,
            "customer_zip_code" => $request->customer_zip_code_origin,
            "zone_code" => $request->zone_code_origin,
            "organization_id" => $request->organization_id_origin,
            "location_id" => $request->location_id_origin,
        ];
        $transaction->destination_data = [
            "customer_name" => $request->customer_name_destination,
            "customer_address" => $request->customer_address_destination,
            "customer_email" => $request->customer_email_destination,
            "customer_phone" => $request->customer_phone_destination,
            "customer_address_detail" => $request->customer_address_detail_destination,
            "customer_zip_code" => $request->customer_zip_code_destination,
            "zone_code" => $request->zone_code_destination,
            "organization_id" => $request->organization_id_destination,
            "location_id" => $request->location_id_destination,
        ];
        $transaction->koli_data = $kolis;
        $transaction->custom_field = [
            "catatan_tambahan" => $request->catatan_tambahan
        ];
        $transaction->currentLocation = [
            "name" => $request->location_name,
            "code" => $request->location_code,
            "type" => $request->location_type
        ];

        $transaction->save();
        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

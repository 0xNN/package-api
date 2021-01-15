<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConnoteResource;
use App\Http\Resources\KoliData;
use App\Models\Transaction;
use App\Models\Koli;
use App\Http\Resources\TransactionResource;
use App\Models\Connote;
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
        // Get All Data From Transaction
        $transaction = TransactionResource::collection(Transaction::all());

        // If Success Get Data Then Response to Json
        if($transaction) {
            return response()->json([
                'data'=>$transaction,
                'response'=>'true',
                'message'=>'success',
                'code'=>'200'
            ], 200);
        }
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
        // Create Validation From Input
        $validator = Validator::make($request->all(),[
            'transaction_id' => 'required|unique:transactions|max:36',
            'customer_name' => 'required',
            'customer_code' => 'required',
            'transaction_amount' => 'required',
            'transaction_discount' => 'required',
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
            'location_code_current' => 'required',
            'location_type_current' => 'required'
        ]);

        // If Fail Validation Then Not Store Data
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        /**
         * Get Data Koli by connote_id
         * And Then Collect Resource Data Koli
         */
        $kolis = Koli::where('connote_id', $request->connote_id)->get();
        $koliResource = KoliData::collection($kolis);

        /** 
         * Get Data connote by transaction_id
         * And Then Collect Resource Connote
         */
        $connote = Connote::where('transaction_id', $request->transaction_id)->get();
        $connoteResource = ConnoteResource::collection($connote);

        // If Success Validation
        // Create New Instance From Transaction And Assign The Value To variable
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
        $transaction->connote = $connoteResource;
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
        $transaction->koli_data = $koliResource;
        $transaction->custom_field = [
            "catatan_tambahan" => $request->catatan_tambahan
        ];
        $transaction->currentLocation = [
            "name" => $request->location_name,
            "code" => $request->location_code_current,
            "type" => $request->location_type_current
        ];
        $transaction->save();
        
        // If Success Store Data Then Response to Json
        if($transaction) {
            return response()->json([
                'data'=>$transaction,
                'response'=>'true',
                'message'=>'success',
                'code'=>'200'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get Data Transaction By transaction_id
        $transaction = Transaction::where('transaction_id', $id)->first();

        // If exist Collect The Data to Resource
        if($transaction) {
            $transactionResource = new TransactionResource($transaction);

            // If Collect Success Response to Json
            if($transactionResource) {
                return response()->json([
                    'data'=>$transactionResource,
                    'response'=>'true',
                    'message'=>'success',
                    'code'=>'200'
                ], 200);
            }
        }
        else { // If Not Success Response to Json With Null Data
            return response()->json([
                'data'=>$transaction,
                'response'=>'true',
                'message'=>'success',
                'code'=>'200'
            ], 200);
        }
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
    public function update(Request $request, $id)
    {
        /**
         * If Method PUT,
         * Then All Variable must be initialized
         * And Validated
         */
        if($request->method() === "PUT") {

            // Create Validation From Input
            $validator = Validator::make($request->all(),[
                'transaction_id' => 'required|max:36',
                'customer_name' => 'required',
                'customer_code' => 'required',
                'transaction_amount' => 'required',
                'transaction_discount' => 'required',
                'transaction_payment_type' => 'required',
                'transaction_state' => 'required',
                'transaction_code' => 'required|max:16',
                'transaction_order' => 'required|numeric',
                'location_id' => 'required|max:24',
                'organization_id' => 'required|numeric',
                'transaction_payment_type_name' => 'required',
                'transaction_cash_amount' => 'required|numeric',
                'transaction_cash_change' => 'required|numeric',
                'Nama_Sales' => 'required|string',
                'TOP' => 'required',
                'Jenis_Pelanggan' => 'required',
                'connote_id' => 'required|max:36',
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
                'location_code_current' => 'required',
                'location_type_current' => 'required'
            ]);
    
            // If Fail Validation Then Not Update Data
            if($validator->fails()) {
                return response()->json($validator->messages(), 200);
            }

            // If Success Validation Then Update Data
            $transaction = Transaction::where('transaction_id',$id);
            $transaction->update($request->all());

            // If Success Update Data Then Response To Json
            if($transaction) {
                return response()->json([
                    'data'=>$request->all(),
                    'method'=>$request->method(),
                    'response'=>'true',
                    'message'=>'success',
                    'code'=>'200'
                ], 200);
            }
        }
        
        /**
         * If Method PATCH,
         * Then Not All Variable must be initialized,
         * Or Can Spesific Variable initial
         */
        
        if($request->method() === "PATCH") {

            // Update Data From Method Patch
            $transaction = Transaction::where('transaction_id',$id);
            $transaction->update($request->all());
        
            // If Success Update Data Then Response to Json
            if($transaction) {
                return response()->json([
                    'data'=>$request->all(),
                    'method'=>$request->method(),
                    'response'=>'true',
                    'message'=>'success',
                    'code'=>'200'
                ], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Data By transaction_id And Delete After it
        $transaction = Transaction::where('transaction_id', $id)->delete();

        // If Delete Success Then Response to Json
        if($transaction) {
            return response()->json([
                'data'=>$transaction,
                'response'=>'true',
                'message'=>'success',
                'code'=>'200'
            ], 200);
        }
    }
}

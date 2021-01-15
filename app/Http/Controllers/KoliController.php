<?php

namespace App\Http\Controllers;

use App\Http\Resources\KoliData;
use App\Http\Resources\TransactionResource;
use App\Models\Koli;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KoliController extends Controller
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
        // Create Validator
        $validator = Validator::make($request->all(),[
            'koli_length' => 'required|numeric',
            'koli_chargeable_weight' => 'required|numeric',
            'koli_width' => 'required|numeric',
            'koli_height' => 'required|numeric',
            'koli_description' => 'required',
            'connote_id' => 'required',
            'koli_volume' => 'required|numeric',
            'koli_weight' => 'required|numeric',
            'koli_id' => 'required|unique:kolis|max:36',
            'koli_code' => 'required',
            'connote_total_package' => 'required'
        ]);

        // If fail validation then not store koli
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        // Get Count Koli From DB
        $kolis_count = Koli::where('connote_id', $request->connote_id)->count();

        // If count < count from request then store koli
        if($kolis_count < $request->connote_total_package) {

            // replace request for koli_code
            $request->merge(['koli_code' => $request->koli_code.'.'.($kolis_count+1)]);

            // Create Instance From Koli And Save to DB
            $kolis = new Koli;
            $kolis->koli_length = $request->koli_length;
            $kolis->awb_url = "https://tracking.mile.app/label/".$request->koli_code;
            $kolis->koli_chargeable_weight = $request->koli_chargeable_weight;
            $kolis->koli_width = $request->koli_width;
            $kolis->koli_surcharge = $request->koli_surcharge;
            $kolis->koli_height = $request->koli_height;
            $kolis->koli_description = $request->koli_description;
            $kolis->koli_formula_id = $request->koli_formula_id;
            $kolis->connote_id = $request->connote_id;
            $kolis->koli_volume = $request->koli_volume;
            $kolis->koli_weight = $request->koli_weight;
            $kolis->koli_id = $request->koli_id;
            $kolis->awb_sicepat = $request->awb_sicepat;
            $kolis->harga_barang = $request->harga_barang;
            $kolis->koli_code = $request->koli_code;
            $kolis->save();

            // If success response data Koli to Json
            if($kolis){
                return response()->json([
                    'data'=>$kolis,
                    'response'=>'true',
                    'message'=>'success',
                    'code'=>200
                ], 200);
            }
        }
        else { // If Count > Count From Request Response "Melebihi Total Paket"
            return response()->json([
                'data'=>[],
                'response'=>'true',
                'message'=>'Melebihi Total Paket',
                'code'=>200
            ], 200);
        }

        // return response()->json($connote_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Koli $koli)
    {
        $kolis = KoliData::collection(Koli::where('connote_id', $koli->connote_id)->get());

        return response()->json($kolis);
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

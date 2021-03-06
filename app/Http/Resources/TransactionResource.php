<?php

namespace App\Http\Resources;

use App\Models\Connote;
use App\Models\Koli;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "transaction_id" => $this->transaction_id,
            "customer_name" => $this->customer_name,
            "customer_code" => $this->customer_code,
            "transaction_amount" => $this->transaction_amount,
            "transaction_discount" => $this->transaction_discount,
            "transaction_additional_field" => $this->transaction_additional_field,
            "transaction_payment_type" => $this->transaction_payment_type,
            "transaction_state" => $this->transaction_state,
            "transaction_code" => $this->transaction_code,
            "transaction_order" => $this->transaction_order,
            "location_id" => $this->location_id,
            "organization_id" => $this->organization_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "transaction_payment_type_name" => $this->transaction_payment_type_name,
            "transaction_cash_amount" => $this->transaction_cash_amount,
            "transaction_cash_change" => $this->transaction_cash_change,
            "customer_attribute" => $this->customer_attribute,
            "connote" => new ConnoteResource(Connote::where('connote_id',$this->connote_id)->first()),
            "connote_id" => $this->connote_id,
            "origin_data" => $this->origin_data,
            "destination_data" => $this->destination_data,
            "koli_data" => KoliData::collection(Koli::where('connote_id',$this->connote_id)->get()),
            "custom_field" => $this->custom_field,
            "currentLocation" => $this->currentLocation,
        ];
    }
}

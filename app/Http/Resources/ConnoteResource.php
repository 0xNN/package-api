<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConnoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'connote_id' => $this->connote_id,
            'connote_number' => $this->connote_number,
            'connote_service' => $this->connote_service,
            'connote_service_price' => $this->connote_service_price,
            'connote_amount' => $this->connote_amount,
            'connote_code' => $this->connote_code,
            'connote_booking_code' => $this->connote_booking_code,
            'connote_order' => $this->connote_order,
            'connote_state' => $this->connote_state,
            'connote_state_id' => $this->connote_state_id,
            'zone_code_from' => $this->zone_code_from,
            'zone_code_to' => $this->zone_code_to,
            'surcharge_amount' => $this->surcharge_amount,
            'transaction_id' => $this->transaction_id,
            'actual_weight' => $this->actual_weight,
            'voluem_weight' => $this->volume_weight,
            'chargeable_weight' => $this->chargeable_weight,
            'organization_id' => $this->organization_id,
            'location_id' => $this->location_id,
            'connote_total_package' => $this->connote_total_package,
            'connote_surcharge_amount' => $this->connote_surcharge_amount,
            'connote_sla_day' => $this->connote_sla_day,
            'location_name' => $this->location_name,
            'location_type' => $this->location_type,
            'source_tariff_db' => $this->source_tariff_db,
            'id_source_tariff' => $this->id_source_tariff,
            'pod' => $this->pod,
            'history' => $this->history,
        ];
    }
}

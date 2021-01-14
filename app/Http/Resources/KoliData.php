<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KoliData extends JsonResource
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
            'koli_length' => $this->koli_length,
            'awb_url' => $this->awb_url,
            'koli_chargeable_weight' => $this->koli_chargeable_weight,
            'koli_width' => $this->koli_width,
            'koli_height' => $this->koli_height,
            'koli_description' => $this->koli_description,
            'connote_id' => $this->connote_id,
            'koli_volume' => $this->koli_volume,
            'koli_weight' => $this->koli_weight,
            'koli_id' => $this->koli_id,
            'koli_code' => $this->koli_code,
        ];
    }
}

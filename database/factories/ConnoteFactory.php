<?php

namespace Database\Factories;

use App\Models\Connote;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConnoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Connote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'connote_id' => $this->faker->asciify('************************************'),
            'connote_number' => $this->faker->numerify('##'),
            'connote_service' => $this->faker->lexify('???'),
            'connote_service_price' => $this->faker->numerify('#####'),
            'connote_amount' => $this->faker->numerify('#####'),
            'connote_code' => $this->faker->bothify('???##############'),
            'connote_booking_code' => "",
            'connote_order' => $this->faker->numerify('######'),
            'connote_state' => "PAID",
            'connote_state_id' => 2,
            'zone_code_from' => "CGKFT",
            'zone_code_to' => "SMG",
            'transaction_id' => $this->faker->asciify('************************************'),
            'actual_weight' => $this->faker->numerify('#'),
            'voluem_weight' => $this->faker->numerify('#'),
            'chargeable_weight' => $this->faker->numerify('#'),
            'organization_id' => 6,
            'location_id' => "5cecb20b6c49615b174c3e74",
            'connote_total_package' => $this->faker->numerify('#'),
            'connote_surcharge_amount' => "0",
            'connote_sla_day' => "4",
            'location_name' => "Hub Jakarta Selatan",
            'location_type' => "HUB",
            'source_tariff_db' => "tariff_customers",
            'id_source_tariff' => "1576868",
            'pod' => null,
            'history' => null
        ];
    }
}

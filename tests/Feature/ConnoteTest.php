<?php

namespace Tests\Feature;

use App\Models\Connote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConnoteTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_an_connote() {

        // make an instance of the Connote Factory
        $connote = Connote::factory()->make();

        // post the data to the connote store method
        $response = $this->post(route('connote.store'), [
            'connote_id' => $connote->connote_id,
            'connote_number' => $connote->connote_number,
            'connote_service' => $connote->connote_service,
            'connote_service_price' => $connote->connote_service_price,
            'connote_amount' => $connote->connote_amount,
            'connote_code' => $connote->connote_code,
            'connote_booking_code' => "",
            'connote_order' => $connote->connote_order,
            'connote_state' => "PAID",
            'connote_state_id' => 2,
            'zone_code_from' => "CGKFT",
            'zone_code_to' => "SMG",
            'transaction_id' => $connote->transaction_id,
            'actual_weight' => $connote->actual_weight,
            'volume_weight' => $connote->volume_weight,
            'chargeable_weight' => $connote->chargeable_weight,
            'organization_id' => 6,
            'location_id' => "5cecb20b6c49615b174c3e74",
            'connote_total_package' => $connote->connote_total_package,
            'connote_surcharge_amount' => "0",
            'connote_sla_day' => "4",
            'location_name' => "Hub Jakarta Selatan",
            'location_type' => "HUB",
            'source_tariff_db' => "tariff_customers",
            'id_source_tariff' => "1576868",
            'pod' => null,
            'history' => null
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('connote', [
            'connote_id' => $connote->connote_id,
            'connote_number' => $connote->connote_number,
            'connote_service' => $connote->connote_service,
            'connote_service_price' => $connote->connote_service_price,
            'connote_amount' => $connote->connote_amount,
            'connote_code' => $connote->connote_code,
            'connote_booking_code' => "",
            'connote_order' => $connote->connote_order,
            'connote_state' => "PAID",
            'connote_state_id' => 2,
            'zone_code_from' => "CGKFT",
            'zone_code_to' => "SMG",
            'transaction_id' => $connote->transaction_id,
            'actual_weight' => $connote->actual_weight,
            'volume_weight' => $connote->volume_weight,
            'chargeable_weight' => $connote->chargeable_weight,
            'organization_id' => 6,
            'location_id' => "5cecb20b6c49615b174c3e74",
            'connote_total_package' => $connote->connote_total_package,
            'connote_surcharge_amount' => "0",
            'connote_sla_day' => "4",
            'location_name' => "Hub Jakarta Selatan",
            'location_type' => "HUB",
            'source_tariff_db' => "tariff_customers",
            'id_source_tariff' => "1576868",
            'pod' => null,
            'history' => null
        ]);
    }
}

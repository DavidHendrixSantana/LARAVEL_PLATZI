<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     protected function setUp(): void

     {
        parent::setUp();
     }


    public function test_index(){
        // En caso de que debamos de crear un usuario para pasar el test
        //con el midleware de sanctum
        Sanctum::actingAs(
            \App\Models\Product::factory()->create()
        );
        \App\Models\Product::factory(5)->create();

        $response = $this->getJson('api/products');
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $response->assertJsonCount(5);
    }
}

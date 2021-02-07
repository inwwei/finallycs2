<?php

namespace Tests\Feature;

use App\Models\Sales\SaleProduct;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SaleProductTest extends TestCase
{
    private $url = 'api/saleproduct';

    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        // กำหนดให้มีการสร้าง User และให้สิทธิ์การ Login ใช้งาน
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );
    }

    /** @test */
    public function officer_can_get_sell_list()
    {
        // Arrange
        SaleProduct::factory()->create();
        $sell = SaleProduct::get();

        // Act
        $response = $this->getJson($this->url);

        // Assert
        $response->assertJson(['data' => $sell->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($sell), 'data');
    }

    public function officer_can_insert_sell_list()
    {
        // Arrange
        $countOld = SaleProduct::count();
        $sell = SaleProduct::factory()->make();

        // Act
        $response = $this->postJson($this->url, $sell->toArray());

        // Assert
        $response->assertJson(['data' => $sell->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('sale_products', $countOld + 1);
    }

    /** @test */
    public function officer_can_update_sell_list()
    {
        // Arrange
        $sell = SaleProduct::factory()->create();
        $newData = SaleProduct::factory()->make();
        $sell->fill($newData->toArray());
        $sell->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$sell->id}", $sell->toArray());

        // Assert
        $response->assertJson(['data' => $sell->toArray()]);
        $response->assertStatus(200);
    }

    public function officer_can_delete_sell_list()
    {
        // Arrange
        $countOld = SaleProduct::count();
        $sell = SaleProduct::factory()->create();

        // Act
        $response = $this->deleteJson("{$this->url}/{$sell->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('sale_products', $countOld + 1);
    }
}

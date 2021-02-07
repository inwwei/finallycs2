<?php

namespace Tests\Feature;

use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductOrderTest extends TestCase
{
    private $url = 'api/productorder';

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
    public function officer_can_get_products_order_list()
    {
        // Arrange
        Order::factory()->create();
        $order = Order::orderBy('created_at')->get();

        // Act
        $response = $this->getJson($this->url);

        // Assert
        $response->assertJson(['data' => $order->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($order), 'data');
    }
    /** @test */
    public function officer_can_insert_product_order()
    {
        // Arrange
        $countOld = Order::count();
        $order = Order::factory()->make();

        // Act
        $response = $this->postJson($this->url, $order->toArray());

        // Assert
        $response->assertJson(['data' => $order->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('orders', $countOld + 1);
    }
    /** @test */
    public function officer_can_update_product_order()
    {
        // Arrange
        $order = Order::factory()->create();
        $newData = Order::factory()->make();
        $order->fill($newData->toArray());
        $order->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$order->id}", $order->toArray());

        // Assert
        $response->assertJson(['data' => $order->toArray()]);
        $response->assertStatus(200);
    }
    /** @test */
    public function officer_can_delete_product_order()
    {
        // Arrange
        $countOld = Order::count();
        $order = Order::factory()->create();

        // Act
        $response = $this->deleteJson("{$this->url}/{$order->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('orders', $countOld + 1);
    }
}

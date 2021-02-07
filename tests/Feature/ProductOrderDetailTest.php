<?php

namespace Tests\Feature;

use App\Models\Orders\OrderDetail;
use App\Models\Orders\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductOrderDetailTest extends TestCase
{
    private $url = 'api/productorder_detail';


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
    public function officer_can_get_products_order_detail_list()
    {
        // Arrange
        $order=Order::factory()->create();
        $details = OrderDetail::factory()->times(1)->make()->toArray();

        foreach ($details as &$detail) {
            $detail['order_id'] = $order->id;
            OrderDetail::create($detail);
        }
        $link = "{$this->url}/{$order->id}";
        // Act
        $response = $this->getJson($link);

        // Assert
        $response->assertJson(['data' => $details]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($details), 'data');
    }
    /** @test */
     public function officer_can_insert_order_detail()
     {
         // Arrange
         $order = Order::factory()->create();
         $oldData = OrderDetail::get()->count();
         $details = OrderDetail::factory()->make();
         $details->order_id = $order->id;
         $link = "{$this->url}/{$order->id}";

         // Act
         $response = $this->postJson($link, $details->toArray());

         // Assert
         $response->assertJson(['data' => $details->toArray()]);
         $response->assertStatus(200);
         $this->assertDatabaseCount('order_details', $oldData + 1);
     }
    /** @test */
    public function officer_can_update_order_detail()
    {
        // Arrange
        $order = Order::factory()->create();
        $details = OrderDetail::factory()->times(5)->make()->toArray();
        foreach ($details as &$detail) {
            $detail['order_id'] = $order->id;
            OrderDetail::create($detail);
        }
        $oldOrderDetail = OrderDetail::where('order_id', $order->id)->first();
        $newOrderDetail = OrderDetail::factory()->make();
        $oldOrderDetail->fill($newOrderDetail->toArray());
        $oldOrderDetail->updated_by = Auth::user()->id;
        $oldOrderDetail = $oldOrderDetail->toArray();
        unset($oldOrderDetail['updated_at']);

        $link = "{$this->url}/{$order->id}/{$oldOrderDetail['id']}";

        // Act
        $response = $this->putJson($link, $oldOrderDetail);

        // Assert
        $response->assertJson(['data' => $oldOrderDetail]);
        $response->assertStatus(200);
    }
    /** @test */
    public function officer_can_delete_order_detail()
    {
        // Arrange
        $oldOrderDetailData = OrderDetail::count();
        $order = Order::factory()->create();
        $details = OrderDetail::factory()->times(5)->make()->toArray();
        foreach ($details as &$detail) {
            $detail['order_id'] = $order->id;
            OrderDetail::create($detail);
        }
        $oldDetail = OrderDetail::where('order_id', $order->id)->first();
        $link = "{$this->url}/{$order->id}/{$oldDetail->id}";

        // Act
        $response = $this->deleteJson($link);

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('order_details', $oldOrderDetailData + 5);
    }
}

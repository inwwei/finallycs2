<?php

namespace Tests\Feature;

use App\Models\Sales\SaleProduct;
use App\Models\Sales\SaleProductDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SaleProductDetailTest extends TestCase
{
    private $url = 'api/saleproductdetail';


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
        $sell = SaleProduct::factory()->create();
        $details = SaleProductDetail::factory()->times(1)->make()->toArray();

        foreach ($details as &$detail) {
            $detail['sell_id'] = $sell->id;
            SaleProductDetail::create($detail);
        }
        $link = "{$this->url}/{$sell->id}";
        // Act
        $response = $this->getJson($link);

        // Assert
        $response->assertJson(['data' => $details]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($details), 'data');
    }
    /** @test */
    public function officer_can_insert_sell_detail()
    {
        // Arrange
        $sell = SaleProduct::factory()->create();
        $oldData = SaleProductDetail::get()->count();
        $details = SaleProductDetail::factory()->make();
        $details->sell_id = $sell->id;
        $link = "{$this->url}/{$sell->id}";

        // Act
        $response = $this->postJson($link, $details->toArray());

        // Assert
        $response->assertJson(['data' => $details->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('sale_product_details', $oldData + 1);
    }
    /** @test */
    public function officer_can_update_sell_detail()
    {
        // Arrange
        $sell = SaleProduct::factory()->create();
        $details = SaleProductDetail::factory()->times(5)->make()->toArray();
        foreach ($details as &$detail) {
            $detail['sell_id'] = $sell->id;
            SaleProductDetail::create($detail);
        }
        $oldSellDetail = SaleProductDetail::where('Sell_id', $sell->id)->first();
        $newSellDetail = SaleProductDetail::factory()->make();
        $oldSellDetail->fill($newSellDetail->toArray());
        $oldSellDetail->updated_by = Auth::user()->id;
        $oldSellDetail = $oldSellDetail->toArray();
        unset($oldSellDetail['updated_at']);

        $link = "{$this->url}/{$sell->id}/{$oldSellDetail['id']}";

        // Act
        $response = $this->putJson($link, $oldSellDetail);

        // Assert
        $response->assertJson(['data' => $oldSellDetail]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_delete_sell_detail()
    {
        // Arrange
        $oldSellDetailData = SaleProductDetail::count();
        $sell = SaleProduct::factory()->create();
        $details = SaleProductDetail::factory()->times(1)->make()->toArray();

        foreach ($details as $detail) {
            $detail['sell_id'] = $sell->id;
            SaleProductDetail::create($detail);
        }


        $oldDetail = SaleProductDetail::where('sell_id', $sell->id)->first();


        $link = "{$this->url}/{$sell->id}/{$oldDetail->id}";

        // Act
        $response = $this->deleteJson($link);

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('sale_product_details', $oldSellDetailData + 1);
    }
}

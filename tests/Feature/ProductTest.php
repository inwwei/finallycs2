<?php

namespace Tests\Feature;

use App\Models\Product\Product;
use App\Models\Settings\SettingMasterProduct;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductTest extends TestCase
{
    private $url = 'api/product';

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
    public function officer_can_get_products_list()
    {
        // Arrange
        SettingMasterProduct::factory()->create();
        Product::factory()->times(5)->create()->sortBy('id')->values();
        $allProducts = Product::get()->sortBy('id')->values();

        // Act
        $response = $this->getJson($this->url);

        // Assert
        $response->assertJson(['data' => $allProducts->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($allProducts), 'data');
    }
    /** @test */
    public function officer_can_insert_product()
    {
        // Arrange
        SettingMasterProduct::factory()->create();
        $countOld = Product::count();
        $productData = Product::factory()->make();

        // Act
        $response = $this->postJson($this->url, $productData->toArray());

        // Assert
        $response->assertJson(['data' => $productData->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('products', $countOld + 1);
    }

    public function officer_can_update_product_type_parts()
    {
        // Arrange
        SettingMasterProduct::factory()->create();
        $productData = Product::factory()->settingMasterProductTypeParts()->create();
        $newData = Product::factory()->settingMasterProductTypeParts()->make();
        $tempNewData = $newData->toArray();
        $newData->new_quantity = $newData->quantity;
        $tempNewData['quantity'] = $newData->quantity + $productData->quantity;
        $tempNewData['maxQuantity'] = $newData->quantity + $productData->quantity;

        // Act
        $response = $this->putJson("{$this->url}/{$productData->id}", $newData->toArray());

        // Assert
        $response->assertJson(['data' => $tempNewData]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_update_product_type_not_parts()
    {
        // Arrange
        SettingMasterProduct::factory()->create();
        $productData = Product::factory()->settingMasterProductTypeNotParts()->create();
        $newData = Product::factory()->settingMasterProductTypeNotParts()->make()->toArray();
        unset($newData['quantity']);// จะไม่ปรับจำนวน ถ้าเป็นของที่ไม่ใช่ อะไหล่
        $productData->fill($newData);
        $productData->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$productData->id}", $productData->toArray());

        // Assert
        $response->assertJson(['data' => $productData->toArray()]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_delete_product()
    {
        // Arrange
        SettingMasterProduct::factory()->create();
        $countOld = Product::count();
        $productData = Product::factory()->create();

        // Act
        $response = $this->deleteJson("{$this->url}/{$productData->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('products', $countOld + 1);
    }
}

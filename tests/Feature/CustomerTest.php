<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use App\Models\CustomerContact;
use App\Models\Settings\SettingMasterCustomer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use DatabaseTransactions;

    private $url = 'api/customers';

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
    public function officer_can_get_customer_list()
    {
        // Arrange
        Customer::factory()->times(5)->create()->sortBy('id')->values();
        $allCustomers = Customer::get()->sortBy('id')->values();

        // Act
        $response = $this->getJson($this->url);

        // Assert
        $response->assertJson(['data' => $allCustomers->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($allCustomers), 'data');
    }

    /** @test */
    public function officer_can_insert_customer()
    {
        SettingMasterCustomer::factory()->create();
        $countOld = Customer::count();
        $customerData = Customer::factory()->make();

        // Act
        $response = $this->postJson($this->url, $customerData->toArray());

        // Assert
        $response->assertJson(['data' => $customerData->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('customers', $countOld + 1);
    }

    /** @test */
    public function officer_can_update_customer()
    {
        // Arrange
        SettingMasterCustomer::factory()->create();
        $customerData = Customer::factory()->create();
        $newData = Customer::factory()->make();
        $customerData->fill($newData->toArray());
        $customerData->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$customerData->id}", $customerData->toArray());

        // Assert
        $response->assertJson(['data' => $customerData->toArray()]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_delete_customer()
    {
        // Arrange
        $countOld = Customer::count();
        $customerData = Customer::factory()->create();
        $link = "{$this->url}/{$customerData->id}";

        // Act
        $response = $this->deleteJson($link);

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('customers', $countOld + 1);
    }

    public function officer_can_insert_customer_with_contact()
    {
        // Arrange
        $customerData = Customer::factory()->make()->toArray();
        $sendData = $customerData;
        $sendData['customer_contact'] = CustomerContact::factory()->times(2)->make()->toArray();

        // Act
        $response = $this->postJson($this->url, $sendData);

        // Assert
        $response->assertJson(['data' => $customerData]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('customer_contacts', 2);
    }
}

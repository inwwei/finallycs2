<?php

namespace Tests\Feature;

use App\Models\Settings\SettingDevice;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingDeviceTest extends TestCase
{
    use DatabaseTransactions;

    private $url = 'api/setting/device';

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
    public function officer_can_get_setting_device_list()
    {
        // Arrange
        $deviceData = SettingDevice::factory()->times(5)->create()->sortBy('id')->values();
        $allDevice = SettingDevice::all();

        // Act
        $response = $this->getJson($this->url);

        // Assert
        $response->assertJson(['data' => $allDevice->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount($allDevice->count(), 'data');
    }

    /** @test */
    public function officer_can_insert_setting_device()
    {
        // Arrange
        $countDevice = SettingDevice::get()->count();
        $deviceData = SettingDevice::factory()->make();

        // Act
        $response = $this->postJson($this->url, $deviceData->toArray());

        // Assert
        $response->assertJson(['data' => $deviceData->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('setting_devices', $countDevice + 1);
    }

     /** @test */
     public function officer_can_update_setting_device()
     {
         // Arrange
         $data = SettingDevice::factory()->create();
         $newData = SettingDevice::factory()->make();
         $data->fill($newData->toArray());
         $data->updated_by = Auth::user()->id;

         // Act
         $response = $this->putJson("{$this->url}/{$data->id}", $data->toArray());

         // Assert
         $response->assertJson(['data' => $data->toArray()]);
         $response->assertStatus(200);
     }

    /** @test */
    public function officer_can_use_setting_device_pin()
    {
        // Arrange
        $deviceData = SettingDevice::factory()->create();
        $countAllDevice = SettingDevice::count();
        $deviceData->updated_by = Auth::user()->id;

        // Act
        $link = $this->url . '/usepin';
        $response = $this->postJson($link, ['pin' => $deviceData->pin]);

        // Assert
        $response->assertJson(['data' => $deviceData->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('setting_devices', $countAllDevice);
    }

    /** @test */
    public function officer_can_not_use_setting_device_pin()
    {
        // Arrange
        $deviceData = SettingDevice::factory()->create();
        $link = $this->url . '/usepin';
        $response = $this->postJson($link, ['pin' => $deviceData->pin]);

        // Act
        $link = $this->url . '/usepin';
        $response = $this->postJson($link, ['pin' => $deviceData->pin]);

        // Assert
        $response->assertJson(['message' => ['ไม่พบข้อมูล PIN ที่จะใช้งาน หรือ ถูกใช้งานไปแล้ว']]);
        $response->assertStatus(400);
    }

    /** @test */
    public function officer_can_check_setting_device_pin()
    {
        // Arrange
        $deviceData = SettingDevice::factory()->create();
        $link = $this->url . '/usepin';
        $response = $this->postJson($link, ['pin' => $deviceData->pin]);
        $deviceData->updated_by = Auth::user()->id;

        // Act
        $link = $this->url . '/checkpin';
        $response = $this->postJson($link, ['pin' => $deviceData->pin]);

        // Assert
        $response->assertJson(['data' => $deviceData->toArray()]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_not_check_setting_device_pin()
    {
        // Arrange
        $deviceData = SettingDevice::factory()->create();

        // Act
        $link = $this->url . '/checkpin';
        $response = $this->postJson($link, ['pin' => $deviceData->pin]);

        // Assert
        $response->assertJson(['message' => ['ไม่พบข้อมูล PIN']]);
        $response->assertStatus(400);
    }

    /** @test */
    public function officer_can_delete_setting_device_pin()
    {
        // Arrange
        $deviceData = SettingDevice::factory()->create();
        $countAllSettingData = SettingDevice::count();

        // Act
        $response = $this->deleteJson("{$this->url}/{$deviceData->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('setting_devices', $countAllSettingData);
    }
}

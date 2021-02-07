<?php

namespace Tests\Feature;

use App\Models\Settings\SettingMasterContact;
use App\Models\Settings\SettingDevice;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Tests\TestCase;

class SettingMasterContactTest extends TestCase
{
    use DatabaseTransactions;

private $url = 'api/setting/master/contact';

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
    public function officer_can_get_setting_master_contact_list()
    {
        // Arrange
        SettingMasterContact::factory()->times(5)->create()->sortBy('id')->values();
        $allData = SettingMasterContact::whereNull('ref_id')->get()->sortBy('id')->values();
        // Act
        $response = $this->getJson($this->url);
        // Assert
        $response->assertJson(['data' => $allData->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($allData), 'data');
    }
    /** @test */
    public function officer_can_insert_setting_master_contact()
    {
        // Arrange
        $data = SettingMasterContact::factory()->make();
        $countOldData = SettingMasterContact::count();

        // Act
        $response = $this->postJson($this->url, $data->toArray());

        // Assert
        $response->assertJson(['data' => $data->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('setting_master_contacts', $countOldData + 1);
    }
    /** @test */
    public function officer_can_update_setting_master_contact()
    {
      $settingData = SettingMasterContact::factory()->create();
        $newData = SettingMasterContact::factory()->make();
       $settingData->fill($newData->toArray());
       $settingData->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$settingData->id}", $settingData->toArray());

        // Assert
        $response->assertJson(['data' => $settingData->toArray()]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_delete_setting_master_contact()
    {
        // Arrange
        $data = SettingMasterContact::factory()->create();
        $countOldData = SettingMasterContact::count();

        // Act
        $response = $this->deleteJson("{$this->url}/{$data->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('setting_master_contacts', $countOldData);
    }
}

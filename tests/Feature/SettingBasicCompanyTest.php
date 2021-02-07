<?php

namespace Tests\Feature;

use App\Models\Settings\SettingBasicCompany;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SettingBasicCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $url = 'api/setting/basic/company';

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
    public function officer_can_get_company_list()
    {
        // Arrange
        SettingBasicCompany::factory()->create();
        $data = SettingBasicCompany::orderBy('created_at')->get();

        // Act
        $response = $this->getJson($this->url);

        // Assert
        $response->assertJson(['data' => $data->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($data), 'data');
    }
    /** @test */
    public function officer_can_insert_company()
    {
        $countOld = SettingBasicCompany::count();
        $branch = SettingBasicCompany::factory()->make();
        // Act
        $response = $this->postJson($this->url, $branch->toArray());
        // Assert
        $response->assertJson(['data' => $branch->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('setting_basic_companies', $countOld + 1);
    }
    /** @test */
    public function officer_can_update_branch()
    {
        // Arrange
        $data = SettingBasicCompany::factory()->create();
        $newData = SettingBasicCompany::factory()->make();
        $data->fill($newData->toArray());
        $data->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$data->id}", $data->toArray());

        // Assert
        $response->assertJson(['data' => $data->toArray()]);
        $response->assertStatus(200);
    }
    /** @test */
    public function officer_can_delete_branch()
    {
        // Arrange
        $countOld = SettingBasicCompany::count();
        $data = SettingBasicCompany::factory()->create();

        // Act
        $response = $this->deleteJson("{$this->url}/{$data->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('setting_basic_companies', $countOld + 1);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Settings\SettingGenerateCode;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SettingBasicGenerateCodeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $url = 'api/setting/generate/code';

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
     public function officer_can_get_generate_code_list()
     {
         // Arrange
         SettingGenerateCode::factory()->create();
         $data = SettingGenerateCode::get();

         // Act
         $response = $this->getJson($this->url);

         // Assert
         $response->assertJson(['data' => $data->toArray()]);
         $response->assertStatus(200);
         $response->assertJsonCount(count($data), 'data');
     }
     /** @test */
     public function officer_can_insert_generate_code()
    {
        $countOld = SettingGenerateCode::count();
        $branch = SettingGenerateCode::factory()->make();

        // Act
        $response = $this->postJson($this->url, $branch->toArray());
        // Assert
        $response->assertJson(['data' => $branch->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('setting_generate_codes', $countOld + 1);
    }
    /** @test */
    public function officer_can_update_generate_code()
    {
        // Arrange
        $data = SettingGenerateCode::factory()->create();
        $newData = SettingGenerateCode::factory()->make();
        $data->fill($newData->toArray());
        $data->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$data->id}", $data->toArray());

        // Assert
        // $response->assertJson(['data' => $data->toArray()]);
        $response->assertStatus(200);
    }
     /** @test */
     public function officer_can_delete_code()
     {
         // Arrange
         $countOld = SettingGenerateCode::count();
         $data = SettingGenerateCode::factory()->create();

         // Act
         $response = $this->deleteJson("{$this->url}/{$data->id}");

         // Assert
         $response->assertStatus(200);
         $this->assertNotNull($response['data']['deleted_at']);
         $this->assertDatabaseCount('setting_generate_codes', $countOld + 1);
     }
}

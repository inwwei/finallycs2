<?php

namespace Tests\Feature;

use App\Models\Settings\SettingBasicBranch;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SettingBasicBranchTest extends TestCase
{
    use DatabaseTransactions;

    private $url = 'api/setting/basic/branch';

    public function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );
    }
    /** @test */
    public function officer_can_get_branch_list()
    {
        // Arrange
        SettingBasicBranch::factory()->create();
        $data = SettingBasicBranch::orderBy('created_at')->get();

        // Act
        $response = $this->getJson($this->url);

        // Assert
        $response->assertJson(['data' => $data->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($data), 'data');
    }
    /** @test */
    public function officer_can_insert_branch()
    {
        // Arrange
        $countOld = SettingBasicBranch::count();
        $branch = SettingBasicBranch::factory()->make();

        // Act
        $response = $this->postJson($this->url, $branch->toArray());

        // Assert
        $response->assertJson(['data' => $branch->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('setting_basic_branches', $countOld + 1);
    }
    /** @test */
    public function officer_can_update_branch()
    {
        // Arrange
        $data = SettingBasicBranch::factory()->create();
        $newData = SettingBasicBranch::factory()->make();
        $data->fill($newData->toArray());
        // $data->updated_by = Auth::user()->id;

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
        $countOld = SettingBasicBranch::count();
        $data = SettingBasicBranch::factory()->create();

        // Act
        $response = $this->deleteJson("{$this->url}/{$data->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('setting_basic_branches', $countOld + 1);
    }
}

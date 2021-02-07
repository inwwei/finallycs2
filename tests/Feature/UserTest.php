<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserTest extends TestCase
{
    private $url = 'api/user';

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
    public function officer_can_get_employees_list()
    {
        //Arrange
        User::factory()->times(5)->create()->sortBy('id')->values();
        $allUserData = User::get()->sortBy('id')->values();
        //Act
        $response = $this->getJson($this->url);
        //Assert
        $response->assertJson(['data' => $allUserData->toArray()]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($allUserData), 'data');
    }

    /** @test */
    public function officer_can_insert_employee()
    {
        // Arrange
        $userData = User::factory()->make();
        $oldData = User::count();

        // Act
        $response = $this->postJson($this->url, $userData->toArray());

        // Assert
        $responseAssert =  $userData->toArray();
        unset($responseAssert['email_verified_at']);
        $response->assertJson(['data' => $responseAssert]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('users', $oldData + 1);
    }

    /** @test */
    public function officer_can_update_employee()
    {
        // Arrange
        $userData = User::factory()->create();
        $newData = User::factory()->make();
        $userData->fill($newData->toArray());
        $userData->updated_by = Auth::user()->id;

        // Act
        $response = $this->putJson("{$this->url}/{$userData->id}", $userData->toArray());

        // Assert
        $response->assertJson(['data' => $userData->toArray()]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_delete_employee()
    {
        // Arrange
        $oldData = User::count();
        $userData = User::factory()->create();

        // Act
        $response = $this->deleteJson("{$this->url}/{$userData->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('users', $oldData + 1);
    }
}

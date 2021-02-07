<?php

namespace Tests\Feature;

use App\Models\UserContact;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserContactTest extends TestCase
{
    private $url = 'api/usercontact';

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
    public function officer_can_get_user_contact_list()
    {
        //Arrange
        $user = User::factory()->create();
        $contacts = UserContact::factory()->times(1)->make()->toArray();
        foreach ($contacts as &$contact) {
            $contact['user_id'] = $user->id;
            UserContact::create($contact);
        }
        $link = "{$this->url}/{$user->id}";
        // dd($link);

        //Act
        $response = $this->getJson($link);

        //Assert
        $response->assertJson(['data' => $contacts]);
        $response->assertStatus(200);
        $response->assertJsonCount(count($contacts), 'data');
    }

     /** @test */
    public function officer_can_insert_user_contact()
    {
        // Arrange
        $user = User::factory()->create();
        $oldData = UserContact::get()->count();
        $contacts = UserContact::factory()->make();
        $contacts->user_id = $user->id;
        $link = "{$this->url}/{$user->id}";

        // Act
        $response = $this->postJson($link, $contacts->toArray());

        // Assert
        $response->assertJson(['data' => $contacts->toArray()]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('user_contacts', $oldData + 1);
    }

    /** @test */
    public function officer_can_update_user_contact()
    {
        // Arrange
        $user = User::factory()->create();
        $contacts = UserContact::factory()->times(5)->make()->toArray();
        foreach ($contacts as &$contact) {
            $contact['user_id'] = $user->id;
            UserContact::create($contact);
        }
        $oldContact = UserContact::where('user_id', $user->id)->first();
        $newContact = UserContact::factory()->make();
        $oldContact->fill($newContact->toArray());
        $oldContact->updated_by = Auth::user()->id;
        $oldContact = $oldContact->toArray();
        unset($oldContact['updated_at']);
        $link = "{$this->url}/{$user->id}/{$oldContact['id']}";

        // Act
        $response = $this->putJson($link, $oldContact);

        // Assert
        $response->assertJson(['data' => $oldContact]);
        $response->assertStatus(200);
    }

    /** @test */
    public function officer_can_delete_user()
    {
        // Arrange
        $oldContactData = UserContact::count();
        $user = User::factory()->create();
        $contacts = UserContact::factory()->times(5)->make()->toArray();
        foreach ($contacts as &$contact) {
            $contact['user_id'] = $user->id;
            UserContact::create($contact);
        }
        $oldContact = UserContact::where('user_id', $user->id)->first();
        $link = "{$this->url}/{$user->id}/{$oldContact->id}";

        // Act
        $response = $this->deleteJson($link);

        // Assert
        $response->assertStatus(200);
        $this->assertNotNull($response['data']['deleted_at']);
        $this->assertDatabaseCount('user_contacts', $oldContactData + 5);
    }
}

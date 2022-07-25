<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCanNotGetList()
    {
        $this->get(route('contacts.index'))
            ->assertRedirect(route('login'));
    }

    public function testCanGetList()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('contacts.index'))
            ->assertStatus(200);
    }

    public function testGuestCanGetCreatePage()
    {
        $this->get(route('contacts.create'))
            ->assertRedirect(route('login'));
    }

    public function testCanGetCreatePage()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('contacts.create'))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Contact/Create'));
    }

    public function testCanCreateContact()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->from(route('contacts.create'))
            ->post(route('contacts.store'), [
                'first_name' => 'First name',
                'last_name' => 'Last name',
                'company_id' => Company::factory()->create()->id,
                'email' => 'contact@contact.com',
                'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            ]);
        $response->assertRedirect(route('contacts.index'))
            ->assertSessionHas('success', 'Create contact success.');
        $this->assertDatabaseHas('contacts', ['first_name' => 'First name', 'last_name' => 'Last name']);
    }

    public function testGuestCanNotGetEditContact()
    {
        $contact = Contact::factory()->create();
        $this->get(route('contacts.edit', $contact))
            ->assertRedirect(route('login'));
    }

    public function testCanGetEditPage()
    {
        $contact = Contact::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('contacts.edit', $contact))
            ->assertInertia(fn(Assert $page) => $page
                ->component('Contact/Edit')
                ->where('contact.id', $contact->id));
    }

    public function testGuestCanNotUpdateContact()
    {
        $contact = Contact::factory()->create();
        $this->put(route('contacts.update', $contact))
            ->assertRedirect(route('login'));
    }

    public function testCanUpdateContact()
    {
        $contact = Contact::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->put(route('contacts.update', $contact), [
                'first_name' => 'First name updated',
                'last_name' => 'Last name updated',
                'company_id' => Company::factory()->create()->id,
                'email' => 'contact@contact.com',
                'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertRedirect(route('contacts.index'))
            ->assertSessionHas('success', 'Update contact success.');
        $this->assertDatabaseHas('contacts', [
            'first_name' => 'First name updated',
            'last_name' => 'Last name updated',
        ]);
    }

    public function testGuestCanNotDelete()
    {
        $contact = Contact::factory()->create();
        $this->delete(route('contacts.destroy', $contact))
            ->assertRedirect(route('login'));
    }

    public function testCanDelete()
    {
        $contact = Contact::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->delete(route('contacts.destroy', $contact))
            ->assertRedirect(route('contacts.index'))
            ->assertSessionHas('success', 'Delete contact success.');
        $this->assertDatabaseMissing('contacts', ['name' => $contact->name]);
    }
}

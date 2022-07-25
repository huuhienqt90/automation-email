<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCanNotGetList()
    {
        $this->get(route('companies.index'))
            ->assertRedirect(route('login'));
    }

    public function testCanGetList()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('companies.index'))
            ->assertStatus(200);
    }

    public function testGuestCanGetCreatePage()
    {
        $this->get(route('companies.create'))
            ->assertRedirect(route('login'));
    }

    public function testCanGetCreatePage()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('companies.create'))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Company/Create'));
    }

    public function testCanCreateCompany()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->from(route('companies.create'))
            ->post(route('companies.store'), [
                'name' => 'Company test',
                'slug' => 'company-test',
                'email' => 'company@company.com'
            ]);
        $response->assertRedirect(route('companies.index'))
            ->assertSessionHas('success', 'Create company success.');
        $this->assertDatabaseHas('companies', ['name' => 'Company test']);
    }

    public function testGuestCanNotGetEditCompany()
    {
        $company = Company::factory()->create();
        $this->get(route('companies.edit', $company))
            ->assertRedirect(route('login'));
    }

    public function testCanGetEditPage()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('companies.edit', $company))
            ->assertInertia(fn(Assert $page) => $page
                ->component('Company/Edit')
                ->where('company.id', $company->id));
    }

    public function testGuestCanNotUpdateCompany()
    {
        $company = Company::factory()->create();
        $this->put(route('companies.update', $company))
            ->assertRedirect(route('login'));
    }

    public function testCanUpdateCompany()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->put(route('companies.update', $company), [
                'name' => $name = $company->name . ' updated',
                'slug' => $company->slug,
                'email' => $company->email
            ])
            ->assertRedirect(route('companies.index'))
            ->assertSessionHas('success', 'Update company success.');
        $this->assertDatabaseHas('companies', ['name' => $name]);
    }

    public function testGuestCanNotDelete()
    {
        $company = Company::factory()->create();
        $this->delete(route('companies.destroy', $company))
            ->assertRedirect(route('login'));
    }

    public function testCanDelete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->delete(route('companies.destroy', $company))
            ->assertRedirect(route('companies.index'))
            ->assertSessionHas('success', 'Delete company success.');
        $this->assertDatabaseMissing('companies', ['name' => $company->name]);
    }
}

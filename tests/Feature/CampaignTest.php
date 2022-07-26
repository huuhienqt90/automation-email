<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCanNotGetList()
    {
        $this->get(route('campaigns.index'))
            ->assertRedirect(route('login'));
    }

    public function testCanGetList()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('campaigns.index'))
            ->assertStatus(200);
    }

    public function testGuestCanGetCreatePage()
    {
        $this->get(route('campaigns.create'))
            ->assertRedirect(route('login'));
    }

    public function testCanGetCreatePage()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('campaigns.create'))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Campaign/Create'));
    }

    public function testCanGetDashboardPage()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();
        $this->actingAs($user)
            ->get(route('campaigns.dashboard', $campaign))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Campaign/Dashboard'));
    }

    public function testCanGetTemplatePage()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();
        $this->actingAs($user)
            ->get(route('campaigns.templates', $campaign))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Campaign/Template'));
    }

    public function testCanGetSchedulePage()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();
        $this->actingAs($user)
            ->get(route('campaigns.schedules', $campaign))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Campaign/Schedule'));
    }

    public function testCanGetSettingPage()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();
        $this->actingAs($user)
            ->get(route('campaigns.settings', $campaign))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('Campaign/Setting'));
    }

    public function testCanCreateCampaign()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->from(route('campaigns.create'))
            ->post(route('campaigns.store'), [
                'name' => 'Campaign test',
                'slug' => 'campaign-test',
            ]);
        $response->assertRedirect(route('campaigns.index'))
            ->assertSessionHas('success', 'Create campaign success.');
        $this->assertDatabaseHas('campaigns', ['name' => 'Campaign test']);
    }

    public function testGuestCanNotGetEditCampaign()
    {
        $campaign = Campaign::factory()->create();
        $this->get(route('campaigns.edit', $campaign))
            ->assertRedirect(route('login'));
    }

    public function testCanGetEditPage()
    {
        $campaign = Campaign::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('campaigns.edit', $campaign))
            ->assertInertia(fn(Assert $page) => $page
                ->component('Campaign/Edit')
                ->where('campaign.id', $campaign->id));
    }

    public function testGuestCanNotUpdateCampaign()
    {
        $campaign = Campaign::factory()->create();
        $this->put(route('campaigns.update', $campaign))
            ->assertRedirect(route('login'));
    }

    public function testCanUpdateCampaign()
    {
        $campaign = Campaign::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->put(route('campaigns.update', $campaign), [
                'name' => $name = $campaign->name . ' updated',
                'slug' => $campaign->slug,
                'email' => $campaign->email,
            ])
            ->assertRedirect(route('campaigns.index'))
            ->assertSessionHas('success', 'Update campaign success.');
        $this->assertDatabaseHas('campaigns', ['name' => $name]);
    }

    public function testGuestCanNotDelete()
    {
        $campaign = Campaign::factory()->create();
        $this->delete(route('campaigns.destroy', $campaign))
            ->assertRedirect(route('login'));
    }

    public function testCanDelete()
    {
        $campaign = Campaign::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->delete(route('campaigns.destroy', $campaign))
            ->assertRedirect(route('campaigns.index'))
            ->assertSessionHas('success', 'Delete campaign success.');
        $this->assertDatabaseMissing('campaigns', ['name' => $campaign->name]);
    }
}

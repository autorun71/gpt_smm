<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\SmmPanel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SmmPanelControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_smm_panels()
    {
        $smmPanel = SmmPanel::factory()->create();

        $response = $this->getJson('/api/smm_panels');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $smmPanel->name]);
    }

    /** @test */
    public function it_can_show_a_smm_panel()
    {
        $smmPanel = SmmPanel::factory()->create();

        $response = $this->getJson("/api/smm_panels/{$smmPanel->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $smmPanel->name]);
    }

    /** @test */
    public function it_can_create_a_smm_panel()
    {
        $data = [
            'name' => 'Test SMM Panel',
            'api_key' => 'api-key-12345',
            'balance' => 100.00,
            'currency' => 'USD',
        ];

        $response = $this->postJson('/api/smm_panels', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Test SMM Panel']);

        $this->assertDatabaseHas('smm_panels', ['name' => 'Test SMM Panel']);
    }

    /** @test */
    public function it_can_update_a_smm_panel()
    {
        $smmPanel = SmmPanel::factory()->create();

        $data = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/smm_panels/{$smmPanel->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('smm_panels', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_a_smm_panel()
    {
        $smmPanel = SmmPanel::factory()->create();

        $response = $this->deleteJson("/api/smm_panels/{$smmPanel->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('smm_panels', ['id' => $smmPanel->id]);
    }
}

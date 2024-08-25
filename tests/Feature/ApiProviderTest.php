<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ApiProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiProviderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_api_provider()
    {
        $data = [
            'name' => 'Test API Provider',
            'api_key' => 'api-key-12345',
            'balance' => 100.00,
            'currency' => 'USD',
        ];

        $apiProvider = ApiProvider::create($data);

        $this->assertDatabaseHas('api_providers', ['name' => 'Test API Provider']);
    }

    /** @test */
    public function it_can_update_an_api_provider()
    {
        $apiProvider = ApiProvider::factory()->create();

        $apiProvider->update(['name' => 'Updated Name']);

        $this->assertDatabaseHas('api_providers', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_an_api_provider()
    {
        $apiProvider = ApiProvider::factory()->create();

        $apiProvider->delete();

        $this->assertSoftDeleted('api_providers', ['id' => $apiProvider->id]);
    }
}

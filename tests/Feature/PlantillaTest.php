<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlantillaTest extends TestCase
{
    // link
    public function test_plantilla_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
 
    // index
    public function test_plantilla_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get('/api/plantilla');
        $response->assertStatus(200);
    }
}

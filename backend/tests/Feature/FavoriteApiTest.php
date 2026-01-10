<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Favorite;

class FavoriteApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_favorites()
    {
        Favorite::factory()->count(3)->create();

        $response = $this->getJson('/api/favorites');
        $response->assertStatus(200)->assertJsonCount(3);       
    }

    /** @test */
    public function it_can_add_a_favorite()
    {
        $data = [
            'tmdb_id' => 123,
            'title' => 'Filme de teste 1',
            'poster_path' => 'https://via.placeholder.com/150',
            'overview' => 'Um filme muito legal sobre a LWSA',
            'release_date' => '2026-01-10',
            'genres' => ['Ação', 'Aventura'],
        ];

        $response = $this->postJson('/api/favorites', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('favorites', ['title' => 'Filme de teste 1']);
    }

    /** @test */
    public function it_can_remove_a_favorite()
    {
        $favorite = Favorite::factory()->create(['tmdb_id' => 123]);
        $response = $this->deleteJson("/api/favorites/123");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('favorites', ['tmdb_id' => 123]);
    }

    
    
}

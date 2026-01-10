<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tmdb_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'title' => $this->faker->sentence(3),
            'poster_path' => '/path.jpg',
            'overview' => $this->faker->paragraph,
            'release_date' => $this->faker->date,
            'genres' => $this->faker->randomElements(['Ação', 'Aventura', 'Comédia', 'Drama', 'Ficção Científica', 'Terror'], 2),
        ];
    }
}

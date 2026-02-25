<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\ColocationUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depence>
 */
class DepenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(3),
            'montant' => fake()->randomFloat(2, 10, 500),
            'colocation_user_id' => ColocationUser::factory(),
            'categorie_id' => Categorie::factory(),
        ];
    }
}

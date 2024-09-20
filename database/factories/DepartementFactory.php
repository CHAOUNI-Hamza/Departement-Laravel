<?php

namespace Database\Factories;

use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departement>
 */
class DepartementFactory extends Factory
{
    protected $model = Departement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word,  // Génère un mot aléatoire pour le nom
            'bio' => $this->faker->paragraph,  // Génère un paragraphe pour la bio
            'image' => $this->faker->imageUrl(640, 480, 'departement', true),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'photo' => $this->faker->imageUrl(640, 480, 'people', true),  // Génère une URL d'image
            'nom' => $this->faker->lastName,  // Génère un nom de famille
            'prenom' => $this->faker->firstName,  // Génère un prénom
            'bio' => $this->faker->paragraph,  // Génère une biographie
            'departement_id' => Departement::factory(),  // Associe un département aléatoire
        ];
    }
}

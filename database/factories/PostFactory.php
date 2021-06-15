<?php

namespace Database\Factories;

use App\Entities\Post;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentences,
            'image' => $this->faker->imageUrl(1200, 720, 'animal'),
            'content' => $this->faker->realTextBetween(1000, 5000),
            'status' => $this->faker->randomElement(['published', 'pending', 'draft']),
            'created_at' => $this->faker->dateTimeBetween('-2 years'),
            'updated_at' => now(),
        ];
    }
}

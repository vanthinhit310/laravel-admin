<?php

namespace Database\Factories\Entities;

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
            'title' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl($width = 1200, $height = 720),
            'content' => $this->faker->realTextBetween(1000, 5000),
            'status' => $this->faker->randomElement(['published', 'pending', 'draft']),
            'created_at' => $this->faker->dateTimeBetween('-2 years'),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Entities\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(500)
            ->has(Post::factory()->count(15), 'posts')
            ->create();
    }
}

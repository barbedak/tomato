<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::factory(200)->create();
        $profiles = Profile::all();
        foreach ($comments as $comment) {
            $profileIds = $profiles->random(fake()->numberBetween(1, count($profiles)))->pluck('id');
        }
    }
}

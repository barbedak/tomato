<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();
        $posts = Post::factory(100)->create();
        foreach ($posts as $post) {
            $tagIds = $tags->random(fake()->numberBetween(1, 5))->pluck('id');
            $post->tags()->sync($tagIds);
            $post->comments()->create([
                'body' => "text from {$post->title}",
                'profile_id'=> Profile::inRandomOrder()->first()->id,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'title' => 'admin',
        ]);
        Role::create([
            'title' => 'moderator_posts',
        ]);
        Role::create([
            'title' => 'viewer_posts',
        ]);
        Role::create([
            'title' => 'moderator_videos',
        ]);
        Role::create([
            'title' => 'viewer_videos',
        ]);
    }
}

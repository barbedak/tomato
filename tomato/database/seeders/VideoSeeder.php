<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create(['title'=>'first video']);
        Video::create(['title'=>'second video']);
        Video::create(['title'=>'third video']);
        Video::create(['title'=>'four video']);
    }
}

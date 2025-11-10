<?php

namespace Database\Seeders;

use App\Models\ThemeMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThemeMessage::factory(2000)->create();
    }
}

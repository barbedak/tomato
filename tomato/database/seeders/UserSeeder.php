<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAdmin = User::create([
            'name' => 'vasya',
            'email' => 'mail@user.ru',
            'password' => bcrypt('123456')
        ]);
        $userAdmin->roles()->syncWithoutDetaching([1, 2, 3, 4, 5]);
        $users = User::factory(4)->create();
        foreach ($users as $user) {
            $user->roles()->syncWithoutDetaching([$user->id]);
//            $user->profile()->create([
//                'name' => fake()->word(),
//                'gender' => fake()->randomElement(['male', 'female']),
//                'country' => fake()->country(),
//                'birthed_at' => fake()->date(),
//                'is_married' => fake()->randomElement([true, false]),
//                'avatar' => fake()->realTextBetween(10, 20),
//            ]);
        }
    }
}

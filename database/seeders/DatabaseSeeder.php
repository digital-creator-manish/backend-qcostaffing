<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            MenusSeeder::class,
            UserSeeder::class,
            FormTypeSeeder::class,
            FormSeeder::class,
            TutorialSeeder::class,
            DisciplineSeeder::class,
        ]);
        \Illuminate\Support\Facades\Artisan::call('passport:install');
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

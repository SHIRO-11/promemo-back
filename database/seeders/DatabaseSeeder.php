<?php

namespace Database\Seeders;

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
            UserSeeder::class,
            CategorySeed::class,
            PostSeeder::class,
            CategoryOrderSeeder::class,
        ]);
        // \App\Models\CategoryOrder::factory(1)->create();
    }
}

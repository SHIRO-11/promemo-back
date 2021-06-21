<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'HTML'
            ],
            [
                'name' => 'CSS'
            ],
            [
                'name' => 'PHP'
            ],
            [
                'name' => 'Ruby'
            ],
            [
                'name' => 'Python'
            ],
        ]);
    }
}

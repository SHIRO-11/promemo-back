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
                'name' => 'HTML',
                'default_color_name' => 'orange1'
            ],
            [
                'name' => 'CSS',
                'default_color_name' => 'orange2'
            ],
            [
                'name' => 'PHP',
                'default_color_name' => 'blue1'
            ],
            [
                'name' => 'Ruby',
                'default_color_name' => 'red1'
            ],
            [
                'name' => 'Python',
                'default_color_name' => 'yellow1'
            ],
        ]);
    }
}

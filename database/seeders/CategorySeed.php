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
                'default_color_name' => 'green3'
            ],
            [
                'name' => 'CSS',
                'default_color_name' => 'pink3'
            ],
            [
                'name' => 'PHP',
                'default_color_name' => 'blue3'
            ],
            [
                'name' => 'Ruby',
                'default_color_name' => 'red3'
            ],
            [
                'name' => 'Python',
                'default_color_name' => 'yellow2'
            ],
        ]);
    }
}

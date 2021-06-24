<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class CategoryOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = 0;
        $category_ids = Post::groupBy('category_id')->get(['category_id'])->pluck('category_id');

        foreach($category_ids as $id){
            $num ++ ;
            DB::table('category_orders')->insert([
                [
                    'user_id' => 1,
                    'category_id' => $id,
                    'order_number' => $num,
                ],
            ]);
        }
    }
}

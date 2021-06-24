<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Log;
use Carbon\Carbon;

class PostFactory extends Factory
{

    protected $model = Post::class;
    protected  $num = 0;

    public function definition()
    {
        $category_id = Category::all()->random(1)[0]->id;
        $post_count = Post::where('category_id',$category_id)->count();
        
        return [
            'title' => 'ダミーデータです。',
            'content' => 'ダミーデータ。ダミーデータ。ダミーデータ。ダミーデータ。',
            'user_id' => 1,
            'category_id' => $category_id,
            'order_number_in_category' => $post_count + 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

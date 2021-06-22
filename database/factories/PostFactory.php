<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Log;

class PostFactory extends Factory
{

    protected $model = Post::class;
    protected  $num = 0;

    public function definition()
    {
        $this->num++;
        return [
            'title' => 'ダミーデータです。',
            'content' => 'ダミーデータ。ダミーデータ。ダミーデータ。ダミーデータ。',
            'user_id' => 1,
            'category_id' => 1,
            'order_number_in_category' => (int)$this->num
        ];
    }
}

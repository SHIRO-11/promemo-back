<?php

namespace Database\Factories;

use App\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;

    public function definition()
    {
        return [
            'title'=>'ダミーデータです。',
            'content'=>'ダミーデータ。ダミーデータ。ダミーデータ。ダミーデータ。',
            'user_id'=>1,
        ];
    }
}

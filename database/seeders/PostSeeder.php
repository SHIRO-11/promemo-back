<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => '【Nuxt.js × moment.js】日時表示操作を簡単にしよう！- Nuxt.jsにmoment.jsを適用させる方法',

                'content' => 'プレーンなJavaScriptでは時間の操作が面倒臭いです。
            そんな時に使うのがこの moment.js 。
            例えば、現在日時の表示を “2020-03-31” の形式にしたいなーと思ったら↓のように記述するだけです。
            ```
            moment().format("YYYY-MM-DD");
            ```
            また、地味に面倒くさい “月末を取得する” なんて処理に対しても便利なメソッドが準備されています。',

                'order_number_in_category' => '1',
                'category_id' => '1',
                'user_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Laravelのfactoryを使って、中間テーブルにデータを挿入したりしてみる。',
                'content' => 'aaa',
                'order_number_in_category' => '1',
                'category_id' => '4',
                'user_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '【Laravel】バリデーションやフォームリクエストのattributesとは？カスタム属性名の設定方法',
                'content' => 'aaa',
                'order_number_in_category' => '1',
                'category_id' => '2',
                'user_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '【本当は教えたくない…】ノンデザイナーだからこそ知っておきたかった7のサイト',
                'content' => 'aa',
                'order_number_in_category' => '1',
                'category_id' => '3',
                'user_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => '【M1】MacにHomebrwがインストールできない「zsh: command not found: brew」',
                'content' => 'aa',
                'order_number_in_category' => '2',
                'category_id' => '2',
                'user_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        \App\Models\Post::factory(10)->create();
    }
}

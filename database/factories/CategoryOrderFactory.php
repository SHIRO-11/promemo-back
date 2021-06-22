<?php

namespace Database\Factories;

use App\Models\CategoryOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryOrderFactory extends Factory
{
    protected $model = CategoryOrder::class;

    protected  $num = 0;

    public function definition()
    {
        $this->num++;
        return [
            'user_id' => 1,
            'category_id' => 1,
            'order_number' => (int)$this->num
        ];
    }
}

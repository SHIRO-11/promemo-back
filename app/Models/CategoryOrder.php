<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'order_number'];
}

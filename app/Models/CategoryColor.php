<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryColor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'color_name'];
}

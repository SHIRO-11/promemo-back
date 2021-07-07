<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['order_number_in_category', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category_color()
    {
        return $this->hasMany(CategoryColor::class)->where('user_id', Auth::guard('sanctum')->id());
    }
    public function isLiked($user_id)
    {
        return $this->likes()->where('user_id', $user_id)->exists();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}

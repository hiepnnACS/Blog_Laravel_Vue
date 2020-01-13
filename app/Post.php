<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'cate_id', 'user_id', 'photo'
    ];
    public function category()
    {
    	return $this->belongsTo(Category::class, 'cate_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

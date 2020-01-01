<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog_Like extends Model
{
    protected $table = "blog_likes";

    protected $fillable = [
        "blog_id",
        "user_id",
        "is_like",
        "created_at",
        "updated_at"
    ];
}

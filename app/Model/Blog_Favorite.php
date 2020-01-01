<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog_Favorite extends Model
{
    protected $table = "blog_favorites";
    protected $fillable = [
        "blog_id",
        "user_id",
        "is_favorite",
        "created_at",
        "updated_at"
    ];
}

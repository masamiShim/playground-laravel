<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post_Like extends Model
{
    protected $table = "post_likes";

    protected $fillable = [
        "post_id",
        "user_id",
        "is_like",
        "created_at",
        "updated_at"
    ];

}

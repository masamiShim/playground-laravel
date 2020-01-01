<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post_Favorite extends Model
{
    protected $table = "post_favorites";

    protected $fillable = [
        "post_id",
        "user_id",
        "is_favorite",
        "created_at",
        "updated_at"
    ];

}

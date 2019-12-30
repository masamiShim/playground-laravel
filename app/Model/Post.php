<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "blog_id",
        "body",
        "created_by",
        "updated_by",
        "deleted_at",
    ];
    //
    protected $table = 'posts';

}

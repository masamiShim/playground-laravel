<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "post_id",
        "body",
        "posted_by",
        "posted_at",
        "created_by",
        "updated_by",
        "deleted_at",
    ];
    //
    protected $table = 'comments';
}

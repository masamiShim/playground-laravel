<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "title",
        "body",
        "posted_at",
        "created_by",
        "updated_by",
        "deleted_at",
    ];
    //
    protected $table = 'blogs';
}

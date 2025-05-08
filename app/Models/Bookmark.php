<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ["user_id", "title", "url"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmarks';

    protected $guarded = [];

    public $timestamps = true;
    public function article() {
        return $this->belongsTo(Article::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

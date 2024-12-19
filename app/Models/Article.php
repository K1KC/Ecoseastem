<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $guarded = [''];


    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function bookmark() {
        return $this->hasMany(Bookmark::class);
    }
}

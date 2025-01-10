<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchandise extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'thumbnail_link','description', 'price', 'stock'];
    public $timestamps = true;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

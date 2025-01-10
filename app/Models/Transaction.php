<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'merchandise_id', 'quantity', 'total_price'];
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function merchandise() {
        return $this->belongsTo(Merchandise::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
  
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'rating','movie_id','ip_address'
    ];
    protected $table = 'rating';
}

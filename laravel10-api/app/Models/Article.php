<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'data_post', 'post_id'
    ];

    public function post()
    {
    	
    // return $this->hasOne(Customer::class);
    return $this->belongsTo(Post::class);
    }
}

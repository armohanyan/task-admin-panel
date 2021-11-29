<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'text', 
    ];

    protected static function newFactory()
    {
        return ArticleFactory::new();
    }

    public function images(){
       return $this->hasMany(Images::class);
    }
}

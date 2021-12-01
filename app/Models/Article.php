<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image ;
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'text',
        'images',
    ];

    protected static function newFactory()
    {
        return ArticleFactory::new();
    }

    public function images(){
       return $this->hasMany(Images::class);
    }
}


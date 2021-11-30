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
        'images',
    ];

    protected static function newFactory()
    {
        return ArticleFactory::new();
    }

    public function images(){
       return $this->hasMany(Images::class);
    }

    public function storeArticleImage($articleId, $images){
        foreach ($images as $image){
            $path = "article{$articleId}/{$image}" ;

            $imageName = $image . '.' . time();
        }

        if( ! file_exists($path) ) mkdir($path, 0777, true) ;

        return  "/$path/";
    }
}

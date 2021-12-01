<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;

class Images extends Model
{
    use HasFactory;


    protected $fillable = [
        'article_id', 
        'name', 
    ];

    protected static function newFactory()
    {
        return ImagesFactory::new();
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }
}

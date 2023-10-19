<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'image_path',
        'is_published'
    ];

    //relacion uno a muchos inverasa

    public function category(){
        return $this->belongsTo(Category::class);
    }


    //relacion muchos a muchos 

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

}

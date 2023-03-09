<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id', 'technology_id', 'cover_image'];
    use HasFactory;

    public static function generateSlug($title){
        return Str::Slug($title, '-');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    } 
}

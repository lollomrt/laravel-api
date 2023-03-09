<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{

    protected $fillable = ['title', 'slug'];
    use HasFactory;

    public static function generateSlug($title){
        return Str::Slug($title, '-');
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}

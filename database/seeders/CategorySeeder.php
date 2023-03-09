<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['HTML', 'CSS', 'VueJs', 'PHP', 'Laravel'];
        foreach($categories as $category){
            $newCategory = new Category();
            $newCategory->title = $category;
            $newCategory->slug = Str::slug($newCategory->title, '-');
            $newCategory->save();
        }
    }
}

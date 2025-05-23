<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Category
{
    use HasFactory;
    protected $table = "categories";

    // public function getMorphClass(): string
    // {
    //     return Category::class;
    // }

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("post", function ($builder) {
            $builder->where("type", 'post');
        });
    }

}

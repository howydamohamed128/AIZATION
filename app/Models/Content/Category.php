<?php

namespace App\Models\Content;

use App\Models\Material;

use App\Traits\Publishable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements HasMedia {
    use HasTranslations, Publishable, InteractsWithMedia ,SoftDeletes , Sluggable;
    use HasFactory;

    protected $fillable = ['name', 'status', 'type','slug'];
    public $translatable = ['name','slug'];


    protected static function booted()
    {
        parent::booted();
        static::creating(function ($model) {
            $slugAr = SlugService::createSlug(Category::class, 'slug', $model->name['ar'] ?? $model->name);
            $slugEn = SlugService::createSlug(Category::class, 'slug', $model->name['en'] ?? $model->name);
            $model->slug = ['ar' => $slugAr, 'en' => $slugEn];
        });

    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }


    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // public function getProductsMainCountAttribute() {
    //     $materials = Material::where('category_id', $this->id)
    //     ->pluck('id')->toArray();

    //     $products = Product::whereIn('material_id', $materials)->get();
    //     return $products->count();
    // }
    // public function getProductsCountAttribute() {
    //     $materials = Material::where('subcategory_id', $this->id)
    //     ->pluck('id')->toArray();

    //     $products = Product::whereIn('material_id', $materials)->get();
    //     return $products->count();
    // }
}

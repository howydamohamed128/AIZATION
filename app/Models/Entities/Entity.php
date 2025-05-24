<?php

namespace App\Models\Entities;

use App\Enum\EntityTypes;
use App\Traits\Publishable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entity extends Model implements HasMedia
{
    use HasTranslations, Publishable, InteractsWithMedia, SoftDeletes;

    use HasFactory;
    protected $fillable = ['name', 'status', 'type','meta_data'];
    public $translatable = ['name','job_title'];
     protected $casts = [
        'meta_data' => 'array',
        'type' => EntityTypes::class,
    ];
 
}

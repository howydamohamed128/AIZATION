<?php

namespace App\Models\Content;

use App\Traits\Publishable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\Conversions\Manipulations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Banner extends Model implements HasMedia
{
    use Publishable, HasTranslations, InteractsWithMedia, HasFactory, SoftDeletes;

    // protected $appends = ['ar', 'en'];
    protected $fillable = [
        'status',
        'title',
        'sub_title',
        'description',
    ];
    public $translatable = ['title', 'sub_title', 'description'];

    public function getArAttribute()
    {
        return $this->getFirstMediaUrl('ar');
    }

    public function getEnAttribute()
    {
        return $this->getFirstMediaUrl('en');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->registerMediaConversions(function (?Media $media = null) {
            $this->addMediaConversion('thumb')
                ->format('webp');
        });
        // $this->addMediaCollection('en')->registerMediaConversions(function (?Media $media = null) {
        //     $this->addMediaConversion('thumb')
        //         ->format('webp');
        // });

    }




}

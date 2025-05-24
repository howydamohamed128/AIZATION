<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Entity
{
    use HasFactory;
    protected $table = "entities";

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("expert", function ($builder) {
            $builder->where("type", 'expert');
        });
    }

}

<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Category extends Model
{
    use HasMediaTrait;

    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}

<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['label', 'explanation', 'is_multiple_choice', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Ansers relation that belongs to this question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class);
    }
}

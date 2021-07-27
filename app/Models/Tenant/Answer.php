<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['label', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name', 'description'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}

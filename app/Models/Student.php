<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['phone_verified', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

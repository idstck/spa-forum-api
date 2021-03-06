<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'title', 'slug', 'description'
    ];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}

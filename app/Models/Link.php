<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'user_id',
        'long_url',
        'short_url_key',
        'visit_count',
    ];

    public function shortUrl(): Attribute
    {
        return Attribute::make(get: fn() => route('short.url', $this->short_url_key));
    }
}

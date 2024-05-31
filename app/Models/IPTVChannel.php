<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPTVChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'name',
        'alt_names',
        'network',
        'owners',
        'country',
        'subdivision',
        'city',
        'broadcast_area',
        'languages',
        'categories',
        'is_nsfw',
        'launched',
        'closed',
        'replaced_by',
        'website',
        'logo',
        'm3u8',
    ];

    protected $casts = [
        'alt_names' => 'array',
        'owners' => 'array',
        'broadcast_area' => 'array',
        'languages' => 'array',
        'categories' => 'array',
        'is_nsfw' => 'boolean',
        'launched' => 'datetime',
        'closed' => 'datetime',
    ];
}

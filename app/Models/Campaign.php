<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'status',
        'is_private',
        'sent_count',
        'fail_count',
        'open_count',
        'reply_count'
    ];

    protected $casts = [
        'status'            => Status::class,
        'is_private'        => 'boolean'
    ];
}

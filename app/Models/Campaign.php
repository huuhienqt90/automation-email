<?php

namespace App\Models;

use App\Enums\CampaignType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Campaign extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'user_id',
        'name',
        'subject',
        'slug',
        'description',
        'send_type',
        'send_values',
        'status',
        'is_private',
        'sent_count',
        'fail_count',
        'open_count',
        'reply_count'
    ];

    protected $casts = [
        'status'            => Status::class,
        'send_type'         => CampaignType::class,
        'is_private'        => 'boolean'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}

<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'company_id',
        'email',
        'first_name',
        'last_name',
        'avatar',
        'job_title',
        'last_campaign',
        'status'
    ];

    protected $casts = [
        'status' => Status::class
    ];

    protected $appends = [
        'avatar_url'
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            if (!str_contains($this->avatar, 'http')) {
                return Storage::url($this->avatar);
            }
            return $this->avatar;
        }
        return asset('assets/images/no-image.jpeg');
    }
}

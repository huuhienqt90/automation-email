<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'phone',
        'email',
        'address',
        'website',
        'fax',
        'status'
    ];

    protected $casts = [
        'status' => Status::class
    ];

    protected $appends = [
        'logo_url'
    ];

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            if (!str_contains($this->logo, 'http')) {
                return Storage::url($this->logo);
            }
            return $this->logo;
        }
        return asset('assets/images/no-image.jpeg');
    }
}

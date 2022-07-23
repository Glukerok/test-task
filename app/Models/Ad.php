<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = [
        'title',
        'price',
        'desc',
    ];

    function photoPreview() {
        return $this->hasOne(Photo::class, 'ad_id')
            ->where('is_preview', '=', 1);
    }

    function photos() {
        return $this->hasMany(Photo::class, 'ad_id');
    }
}

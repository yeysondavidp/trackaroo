<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'description',
        'comments',
        'details'=>'array',
        'address',
        'start_photos',
        'start_time',
        'start_gps',
        'finish_photos',
        'finish_time',
        'finish_gps',
        'status',
        'expected_date'
    ];

    // Generate random code
    protected static function booted()
    {
        static::creating(function ($project) {
            if (empty($project->code)) {
                // alphanumeric code 6 digits
                do {
                    $code = Str::upper(Str::random(6));
                } while (self::where('code', $code)->exists());

                $project->code = $code;
            }
        });
    }
}

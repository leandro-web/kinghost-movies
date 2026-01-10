<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',
        'poster_path',
        'overview',
        'release_date',
        'genres',
    ];

    protected $casts = [
        'genres' => 'array',
    ];
}

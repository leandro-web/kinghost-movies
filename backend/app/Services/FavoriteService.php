<?php

namespace App\Services;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Collection;

class FavoriteService
{
    public function getAllFavorites()
    {
        return Favorite::all();
    }

    public function addFavorite(array $data)
    {
        return Favorite::firstOrCreate(['tmdb_id' => $data['tmdb_id']], $data);
    }

    public function removeFavorite(int $tmdb_id)
    {
        return Favorite::where('tmdb_id', $tmdb_id)->delete();
    }
}
<?php

namespace App\Http\Controllers;

use App\Services\TmdbService;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Exception;

class MovieController extends Controller
{
    protected TmdbService $tmdbService;

    public function __construct(TmdbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if(!$query) {
            return response()->json(['result' => []]);
        }

        try {
            $data = $this->tmdbService->searchMovies($query);
            $data = $this->markfavorites($data);

            return response()->json([$data]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao buscar filmes'], 503);
        }
    }

    public function popular()
    {
        try {
            $data = $this->tmdbService->getPopularMovies();
            $data = $this->markfavorites($data);
            return response()->json([$data]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao buscar filmes'], 503);
        }
    }

    private function markfavorites(array $tmdbData)
    {
        if(empty($tmdbData['results'])) {
            return $tmdbData;
        }

        $tmdbIds = collect($tmdbData['results'])->pluck('id');
        $existingFavorites = Favorite::whereIn('tmdb_id', $tmdbIds)->pluck('tmdb_id')->toArray();

        foreach($tmdbData['results'] as &$movie) {
            $movie['is_favovorite'] = in_array($movie['id'], $existingFavorites);
        }
        return $tmdbData;        
    }
}

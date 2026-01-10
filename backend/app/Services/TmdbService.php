<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Exception;
use Illuminate\Support\Facades\Cache;

class TmdbService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.tmdb.base_url');
        $this->apiKey = config('services.tmdb.api_key');
    }

    private function get(string $endpoint, array $params = [])
    {
        $cachekey = 'tmdb_' . $endpoint . '_' . http_build_query($params);

        return Cache::remember($cachekey, 60 * 60, function () use ($endpoint, $params) {
            $queryParams = array_merge($params, [
                'api_key' => $this->apiKey,
                'language' => 'pt-BR',
            ]);
            $response = Http::get("{$this->baseUrl}{$endpoint}", $queryParams);

            if ($response->failed()) {
                throw new Exception("Erro na comunicação com a API TMDB: {$response->status()}");
            }
            return $response->json();
        });
    }

    public function searchMovies(string $query)
    {
        return $this->get('/search/movie', ['query' => $query]);
    }

    public function getPopularMovies()
    {
        return $this->get("/movie/popular");
    }
}
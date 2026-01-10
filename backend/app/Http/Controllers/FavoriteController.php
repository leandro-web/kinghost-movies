<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\FavoriteRequest;
use App\Service\FavoriteService;
use Illuminate\Http\JsonResponse;
use Exception;

class FavoriteController extends Controller
{
    protected FavoriteService $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function index()
    {
        try {
            $favorites = $this->favoriteService->getAllFavorites();
            return response()->json([$favorites]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao buscar favoritos'], 503);
        }
    }

    public function store(FavoriteRequest $request)
    {
        try {
            $favorite =$this->favoriteService->addFavorite($request->validated());
            return response()->json($favorite, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao adicionar filme aos favoritos'], 503);
        }
    }

    public function destroy($tmdb_id)
    {
        try {
            $deleted = $this->favoriteService->removeFavorite($tmdb_id);
            if(!$deleted) {
                return response()->json(['error' => 'Filme não encontrado'], 404);
            }
            return response()->json(['message' => 'Filme removido dos favoritos'], 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'Falha ao remover filme dos favoritos'], 503);
        }
    }
    
}

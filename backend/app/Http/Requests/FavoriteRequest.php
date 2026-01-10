<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tmdb_id'       => 'required|integer',
            'title'         => 'required|string',
            'poster_path'   => 'nullable|string',
            'overview'      => 'nullable|string',
            'release_date'  => 'nullable|string',
            'genres'        => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'tmdb_id.required' => 'O ID do filme é obrigatório',
            'tmdb_id.integer' => 'O ID do filme deve ser um número inteiro',
            'title.required' => 'O título do filme é obrigatório',
            'title.string' => 'O título do filme deve ser uma string',
            'poster_path.string' => 'O caminho do poster do filme deve ser uma string',
        ];
    }
}

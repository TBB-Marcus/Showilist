<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class GenreService
{
    protected $cacheKey = 'tmdb_genres';

    public function getGenres()
    {
        return Cache::remember($this->cacheKey, now()->addDays(7), function () {
            $client = new Client();
            $response = $client->get(env('TMDB_URL') . 'genre/tv/list', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
                ],
                'query' => [
                    'language' => 'en-US',
                ]
            ]);
            $genres = json_decode($response->getBody(), true)['genres'] ?? [];
            // Store as [id => name]
            return collect($genres)->pluck('name', 'id')->toArray();
        });
    }

    public function getGenreName($id)
    {
        $genres = $this->getGenres();
        return $genres[$id] ?? 'Unknown';
    }

    public function getGenreNames(array $ids)
    {
        $genres = $this->getGenres();
        return collect($ids)->map(fn($id) => $genres[$id] ?? 'Unknown')->all();
    }
}

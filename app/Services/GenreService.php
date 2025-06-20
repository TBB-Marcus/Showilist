<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class GenreService
{
    protected $cacheKey = 'tmdb_genres';

    /**
     * Get all TV genres from TMDB and caches them for 7 days.
     * Returns an associative array with genre IDs as keys and names as values.
     * @return array
     */
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

    /**
     * Get a single genre name by ID.
     * Returns 'Unknown' if the ID does not exist.
     * @param int $id
     * @return string
     */
    public function getGenreName($id)
    {
        $genres = $this->getGenres();
        return $genres[$id] ?? 'Unknown';
    }

    /**
     * Get genre names for an array of genre IDs.
     * Returns an array of genre names, with 'Unknown' for any IDs that do not exist.
     * @param array $ids
     * @return array
     */
    public function getGenreNames(array $ids)
    {
        $genres = $this->getGenres();
        return collect($ids)->map(fn($id) => $genres[$id] ?? 'Unknown')->all();
    }
}

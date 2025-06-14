<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TMDBController extends Controller
{

    /**
     * Get the top series from the TMDB API.
     * @return JSON response with the top shows.
     */
    public function getTopShows() {
        $client = new Client();

        $response = $client->get(env('TMDB_URL') . 'discover/tv', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
            'query' => [
                'sort_by' => 'popularity.desc',
                'language' => 'en-US',
                'without_genres' => '10764,10767,10763',
                'first_air_date.gte' => '2008-01-01',
                'page' => 1,
            ]
        ]);
        $shows = json_decode($response->getBody());
        return view('index', ['shows' => $shows]);
    }


}

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

        $response = $client->get(env('TMDB_URL') . 'trending/tv/week', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
            'query' => [
                'page' => 1
            ]
        ]);
        $shows = json_decode($response->getBody());
        $shows = $shows->results;
        return view('index', ['shows' => $shows]);
    }


    /**
     * Get details of a specific show.
     * Used for the individual show pages.
     * @return JSON response with show details.
     */
    public function getShowDetails($id) {
        $client = new Client();

        $reponse = $client->get(env('TMDB_URL') . '/tv/' . $id, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
            'query' => [
                'append_to_response' => 'videos'
            ]
        ]);

        $show = json_decode($reponse->getBody());
        return view('show', ['show' => $show]);
    }


}

<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TMDBController extends Controller
{

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

<?php

namespace App\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class Search extends Component
{

    public $shows;
    public $page = 1;
    public $query = '';

    /**
     * Mount the component with initial data.
     * Fetches the trending TV shows from TMDB API.
     */
    public function mount()
    {
        $client = new Client();

        $response = $client->get(env('TMDB_URL') . 'trending/tv/week', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
        ]);
        $shows = json_decode($response->getBody());
        $shows = $shows->results;
        $this->shows = $shows;
    }

    public function updatedQuery($value)
    {
        $this->query = $value;

        if (strlen($this->query) <= 0) {
            $this->mount();
            return;
        }

        $client = new Client();

        $response = $client->get(env('TMDB_URL') . 'search/tv', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
            'query' => [
                'page' => $this->page,
                'query' => $this->query,
            ]
        ]);

        $shows = json_decode($response->getBody());
        $shows = $shows->results;
        $this->shows = $shows;
    }



    public function render()
    {
        return view('livewire.search');
    }
}

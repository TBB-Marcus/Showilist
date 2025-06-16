<?php

namespace App\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class PopularPagnation extends Component
{

    public $shows;
    public $page = 1;

    /**
     * Mount the component with initial data.
     */
    public function mount()
    {
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
                'page' => 1,
            ]
        ]);
        $shows = json_decode($response->getBody());
        $shows = $shows->results;
        $this->shows = $shows;
    }

    public function nextPage()
    {
        $this->page++;
        $this->loadShows();
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadShows();
        }
    }

    public function loadShows()
    {
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
                'page' => $this->page,
            ]
        ]);
        $shows = json_decode($response->getBody());
        $this->shows = $shows->results;
        $this->dispatch('shows-loaded');
    }

    public function render()
    {
        return view('livewire.popular-pagnation');
    }
}

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
        $this->page = 1;
        $client = new Client();

        $response = $client->get(env('TMDB_URL') . 'trending/tv/week', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
            'query' => [
                'page' => $this->page,
            ]
        ]);
        $shows = json_decode($response->getBody());
        $shows = $shows->results;
        $this->shows = $shows;
    }

    /**
     * Updates the query and fetches loadshows based on the new query.
     * This method automatically triggers when the user types in the search input marked with wire:model="query".
     * @param string $value query
     */
    public function updatedQuery($value)
    {

        $this->query = $value;

        if (strlen($this->query) <= 0) {
            $this->mount();
            return;
        }

        $this->loadShows();
    }

    /**
     * Fetches shows from the TMDB API based on the current query and page.
     * This method is called when the user searches for a show.
     */
    public function loadShows()
    {
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

    public function nextPage()
    {
        $this->page++;
        $this->updatedQuery($this->query);
        $this->dispatch('shows-loaded');
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->updatedQuery($this->query);
            $this->dispatch('shows-loaded');
        }
    }



    public function render()
    {
        return view('livewire.search');
    }
}

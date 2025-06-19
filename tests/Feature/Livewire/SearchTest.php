<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Search;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(Search::class)
            ->assertStatus(200);
    }

    public function test_mounts_with_shows()
    {
        Livewire::test(Search::class)
            ->assertViewHas('shows')
            ->assertViewIs('livewire.search');
    }

    public function test_mounts_with_empty_query()
    {
        Livewire::test(Search::class)
            ->assertSet('query', '')
            ->assertViewHas('shows')
            ->assertViewIs('livewire.search');
    }

    public function test_updates_query_and_loads_shows()
    {
        $query = 'Breaking Bad';
        Livewire::test(Search::class)
            ->set('query', $query)
            ->assertSet('query', $query)
            ->assertViewHas('shows');
    }

    public function test_next_page_increments_page_and_loads_shows()
    {
        $query = 'Breaking Bad';
        Livewire::test(Search::class)
            ->set('query', $query)
            ->set('page', 1)
            ->call('nextPage')
            ->assertSet('page', 2)
            ->assertViewHas('shows');
    }

    public function test_previous_page_decrements_page_and_loads_shows()
    {
        Livewire::test(Search::class)
            ->set('page', 2)
            ->call('previousPage')
            ->assertSet('page', 1)
            ->assertViewHas('shows');
    }

    public function test_previous_page_does_not_decrement_below_one()
    {
        Livewire::test(Search::class)
            ->call('previousPage')
            ->assertSet('page', 1)
            ->assertViewHas('shows');
    }
}

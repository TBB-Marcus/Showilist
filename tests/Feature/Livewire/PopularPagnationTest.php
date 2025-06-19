<?php

namespace Tests\Feature\Livewire;

use App\Livewire\PopularPagnation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PopularPagnationTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(PopularPagnation::class)
            ->assertStatus(200);
    }

    /** @test */
    function test_loads_shows_on_mount()
    {
        Livewire::test(PopularPagnation::class)
            ->assertViewHas('shows')
            ->assertViewIs('livewire.popular-pagnation');
    }

    /** @test */
    function test_next_page_increments_page_and_loads_shows()
    {
        Livewire::test(PopularPagnation::class)
            ->call('nextPage')
            ->assertSet('page', 2)
            ->assertViewHas('shows');
    }

    /** @test */
    function test_previous_page_decrements_page_and_loads_shows()
    {
        Livewire::test(PopularPagnation::class)
            ->set('page', 2)
            ->call('previousPage')
            ->assertSet('page', 1)
            ->assertViewHas('shows');
    }

    /** @test */
    function test_previous_page_does_not_decrement_below_one()
    {
        Livewire::test(PopularPagnation::class)
            ->call('previousPage')
            ->assertSet('page', 1)
            ->assertViewHas('shows');
    }

}

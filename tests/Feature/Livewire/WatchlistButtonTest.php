<?php

namespace Tests\Feature\Livewire;

use App\Livewire\WatchlistButton;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class WatchlistButtonTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        Livewire::test(WatchlistButton::class, ['showId' => 37854])
            ->assertStatus(200);
    }

    public function test_mounts_with_no_favorite()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        Livewire::test(WatchlistButton::class, ['showId' => 37854])
            ->assertViewHas('status', '')
            ->assertViewIs('livewire.watchlist-button');
    }

    public function test_mounts_with_existing_favorite()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        \App\Models\Favorite::create([
            'user_id' => $user->id,
            'show_id' => 37854,
            'status' => 'watching',
        ]);

        Livewire::test(WatchlistButton::class, ['showId' => 37854])
            ->assertSet('status', 'watching')
            ->assertViewHas('status')
            ->assertViewIs('livewire.watchlist-button');
    }

    public function test_adds_show_to_watchlist_and_caches_show()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        $fakeShow = (object)[
            'genres' => [
                ['id' => 1],
                ['id' => 2],
            ],
            'name' => 'Fake Show',
            'vote_average' => 8.5,
            'original_language' => 'en',
            'first_air_date' => '2020-01-01',
            'poster_path' => '/poster.jpg',
            'backdrop_path' => '/backdrop.jpg',
        ];

        Livewire::test(WatchlistButton::class, [
                'showId' => 37854,
                'show' => $fakeShow,
            ])
            ->set('status', 'watching')
            ->assertSet('status', 'watching')
            ->assertViewHas('status');

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'show_id' => 37854,
            'status' => 'watching',
        ]);
    }
}

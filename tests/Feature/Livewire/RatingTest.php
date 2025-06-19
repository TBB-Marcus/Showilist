<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Rating;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class RatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        $showId = 37854; // One Piece
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        Livewire::test(Rating::class)
            ->assertStatus(200);
    }

    /** @test */
    public function test_mounts_with_no_rating()
    {
        $showId = 37854; // One Piece
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        Livewire::test(Rating::class, ['showId' => $showId])
            ->assertViewHas('rating', 0)
            ->assertViewIs('livewire.rating');
    }

    public function test_mounts_with_existing_rating()
    {
        $showId = 37854; // One Piece
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        \App\Models\Review::create([
            'user_id' => $user->id,
            'show_id' => $showId,
            'rating' => 8,
        ]);

        Livewire::test(Rating::class, ['showId' => $showId])
            ->assertSet('rating', 8)
            ->assertViewHas('rating')
            ->assertViewIs('livewire.rating');
    }

    /** @test */
    public function test_updates_rating()
    {
        $showId = 37854; // One Piece
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        Livewire::test(Rating::class, ['showId' => $showId])
            ->set('review', 8)
            ->assertSet('rating', 8);
    }
}

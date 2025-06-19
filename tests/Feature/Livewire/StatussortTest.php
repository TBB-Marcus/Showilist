<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Statussort;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class StatussortTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);
        Livewire::test(Statussort::class)
            ->assertStatus(200);
    }

    public function test_mounts_with_no_shows_if_there_is_no_favorite()
    {
        Livewire::test(Statussort::class)
            ->assertViewHas('shows', new \Illuminate\Database\Eloquent\Collection())
            ->assertViewIs('livewire.statussort');
    }

    public function test_mounts_with_shows_if_favorites_exist()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        // Create a favorite show for the user
        \App\Models\Favorite::create([
            'user_id' => $user->id,
            'show_id' => 37854, // Assuming show_id 1 exists in the database
            'status' => 'watching',
        ]);

        Livewire::test(Statussort::class)
            ->assertViewHas('shows')
            ->assertViewIs('livewire.statussort');
    }

    public function test_sort_by_status_updates_shows()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        \App\Models\Show::create([
            'show_id' => 37854,
            'name' => 'One Piece',
        ]);
        \App\Models\Show::create([
            'show_id' => 37855,
            'name' => 'Another Show',
        ]);

        \App\Models\Favorite::create([
            'user_id' => $user->id,
            'show_id' => 37854,
            'status' => 'watching',
        ]);
        \App\Models\Favorite::create([
            'user_id' => $user->id,
            'show_id' => 37855,
            'status' => 'completed',
        ]);

        Livewire::test(Statussort::class)
            ->call('sortByStatus', 'watching')
            ->assertViewHas('shows', function ($shows) {
                return $shows->count() == 1;
            });
    }
}

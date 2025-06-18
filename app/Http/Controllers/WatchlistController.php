<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Show;

class WatchlistController extends Controller
{
    public function getWatchlist(Request $request) {
    $favoriteShowIds = Favorite::where('user_id', $request->user()->id)
        ->orderBy('created_at', 'desc')
        ->pluck('show_id')
        ->toArray();

    // Fetch all shows in one query
    $shows = Show::whereIn('show_id', $favoriteShowIds)->get();

    return view('watchlist', [
        'shows' => $shows, // No extra array wrapping
    ]);
}

    public function createFavorite(Request $request, $id) {
        $request->validate([
            'status' => 'required|string|in:planning,watching,completed,paused,dropped'
        ]);

        Favorite::create([
            'user_id' => $request->user()->id,
            'show_id' => $id,
            'status' => $request->input('status')
        ]);

        return back()->with('success', 'Show added to watchlist successfully.');
    }

    public function deleteFavorite(Request $request, $id) {

        $favorite = Favorite::where('user_id', $request->user()->id)
                            ->where('show_id', $id)
                            ->first();

        $favorite->delete();
        return back()->with('success', 'Show removed from watchlist successfully.');
    }
}

<x-app-layout title="{{ Auth::user()->username }}'s Watchlist">
    <div class="text-textbase ml-15 mt-15">
        <h1 class="text-3xl">Welcome to your watchlist!</h1>
        <p class="">Below are all the shows you have added to your list.</p>
    </div>
    @livewire('statussort')
</x-app-layout>

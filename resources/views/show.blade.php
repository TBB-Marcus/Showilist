@php
    function formatAirDate($date) {
        if (!$date) return '';
        $dt = \Carbon\Carbon::parse($date);
        return $dt->format('j F Y');
    }

    $chosenVid = null;

    foreach($show->videos->results as $video) {
        if ($video->type === 'Trailer' && $video->site === 'YouTube') {
            $chosenVid = $video;
            break;
        }
        if($video->site === 'YouTube') {
            $chosenVid = $video;
        }
    }
@endphp

<x-app-layout title="{{ $show->name }}">
    <div class="relative text-textbase">
    <img src="https://image.tmdb.org/t/p/w1280{{ $show->backdrop_path }}" alt="{{ $show->name }}" class="w-full h-96 object-cover">
    <div class="absolute top-0 left-0 w-full h-96">
        <div class="flex h-full items-end px-4 md:px-10 pb-0 md:pb-8 relative z-10">
            <div class="relative">
                <img src="https://image.tmdb.org/t/p/w300{{ $show->poster_path }}" alt="{{ $show->name }}" class="w-40 md:w-48 h-60 md:h-72 object-cover rounded-lg shadow-lg border-white border-2 translate-y-0 md:translate-y-70">
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row w-full gap-6 px-4 md:px-10 mt-6 md:mt-16">
        <div class="hidden md:block w-48 shrink-0"></div>
        <div class="flex-1 flex flex-col">
            @if (isset($show->homepage))
                <span class="flex items-center">
                    <a href="{{ $show->homepage }}" class="inline-flex text-3xl font-bold hover:text-texthover transition-all items-center"><u>{{ $show->name }}</u></a>
                    <span class="pl-4 flex items-center font-bold text-3xl"><p>8.9</p><i class="fa-solid fa-star text-yellow-500 ml-3" aria-hidden="true"></i></span>
                </span>
            @else
                <p class="text-3xl font-bold hover:text-texthover transition-all">
                    {{ $show->name }}
                    <span class="pl-4">{{ number_format($show->vote_average, 1) }} <i class="fa-solid fa-star text-yellow-500"></i></span>
                </p>
            @endif

            <p class="text-base mb-4 mt-3 hover:text-texthover transition-all md:w-3/4">{{ $show->overview }}</p>

            @if (Auth::check())
                @livewire('watchlist-button', ['showId' => $show->id, 'show' => $show])
                @livewire('rating', ['showId' => $show->id])
            @else
                <p><u><a href="auth?login">Log in</a></u> to add this show to your list, or to give it a rating</p>
            @endif
        </div>
    </div>
    <div class="bg-contrast-darker flex flex-col md:flex-row p-6 md:p-20 mt-10 gap-6">
        <div class="w-full md:w-1/3 pt-2 md:pt-5">
            <p class="bg-default rounded-xl border border-textbase p-2">Status: <b>{{ $show->status }}</b></p>
            <p class="bg-default rounded-xl border border-textbase p-2 mt-2">Release Date: <b>{{ formatAirDate($show->first_air_date) }}</b><br>Last Aired: <b>{{ formatAirDate($show->last_air_date) }}</b></p>
            <p class="bg-default rounded-xl border border-textbase p-2 mt-2">Genre: <b>{{ $show->genres[0]->name }}</b></p>
            <p class="bg-default rounded-xl border border-textbase p-2 mt-2">Number of seasons: <b>{{ $show->number_of_seasons }}</b></p>
            <p class="bg-default rounded-xl border border-textbase p-2 mt-2">Number of episodes: <b>{{ $show->number_of_episodes }}</b></p>
            <p class="bg-default rounded-xl border border-textbase p-2 mt-2">Original language: <b>{{ strtoupper($show->original_language) }}</b></p>
            <p class="bg-default rounded-xl border border-textbase p-2 mt-2">
                <span>Production Company:</span>
                <b class="block break-words">{{ $show->production_companies[0]->name }}</b>
            </p>
        </div>
        <div class="w-full md:w-2/3 mt-5 md:mt-0">
            <div class="aspect-video w-full max-w-5xl mx-auto md:mx-0">
                @if (isset($chosenVid))
                    <iframe
                        class="w-full h-full rounded-lg"
                        src="{{ 'https://www.youtube.com/embed/' . $chosenVid->key }}"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                @else
                    <div class="bg-default p-4 rounded-lg">
                        <p>Sorry! We couldn't find a trailer for this show.</p>
                        @if (isset($show->homepage))
                            <p>You could try visiting the show's <a href="{{ $show->homepage }}"><u>homepage</u></a></p>
                        @endif
                        <p>For now, take this cat instead: <b>ᓚᘏᗢ</b></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

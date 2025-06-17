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

<x-app-layout title="">
    <div class="relative text-textbase">
        <img src="https://image.tmdb.org/t/p/w1280{{ $show->backdrop_path }}" alt="{{ $show->name }}" class="w-full h-96 object-cover">
        <div class="absolute top-0 left-0 w-full h-96">
            <div class="flex h-full items-end px-8 pb-8 relative z-10">
                <div class="relative">
                    <img
                        src="https://image.tmdb.org/t/p/w300{{ $show->poster_path }}"
                        alt="{{ $show->name }}"
                        class="w-48 h-72 object-cover rounded-lg shadow-lg border-white border-2 translate-y-8/9"
                    >
                </div>
            </div>
        </div>
        <div class="flex w-full gap-8 px-z8 mt-10 pl-10 min-h-1/5">
            <div class="w-48"></div>
            <div class="flex-1">
                @if (isset($show->homepage))
                    <a href="{{ $show->homepage }}" class="text-3xl font-bold hover:text-texthover transition-all"><u>{{ $show->name }}</u><span class="pl-4">{{number_format($show->vote_average, 1)}} <i class="fa-solid fa-star text-yellow-500"></i></span></a>
                @else
                    <p class="text-3xl font-bold hover:text-texthover transition-all">{{ $show->name }}<span class="pl-4">{{number_format($show->vote_average, 1)}} <i class="fa-solid fa-star text-yellow-500"></i></span></p>
                @endif
                <p class="text-base mb-4 w-3/4 hover:text-texthover transition-all mt-3">{{ $show->overview }}</p>
            </div>
        </div>
        <div class="bg-contrast-darker grid grid-cols-2 p-20 mt-20">
            <div class="pl-5 w-2/3 h-full pt-5">
                <p class="bg-default rounded-xl border-1 border-textbase p-2">Status: <b>{{ $show->status }}</b></p>
                <p class="bg-default rounded-xl border-1 border-textbase p-2 mt-2">Release Date: <b>{{ formatAirDate($show->first_air_date) }}</b><br>Last Aired: <b>{{ formatAirDate($show->last_air_date) }}</b></p>
                <p class="bg-default rounded-xl border-1 border-textbase p-2 mt-2">Genre: <b>{{ $show->genres[0]->name }}</b></p>
                <p class="bg-default rounded-xl border-1 border-textbase p-2 mt-2">Number of seasons: <b>{{ $show->number_of_seasons }}</b></p>
                <p class="bg-default rounded-xl border-1 border-textbase p-2 mt-2">Number of episodes: <b>{{ $show->number_of_episodes }}</b></p>
                <p class="bg-default rounded-xl border-1 border-textbase p-2 mt-2">Original language: <b>{{ strtoupper($show->original_language) }}</b></p>
                <p class="bg-default rounded-xl border-1 border-textbase p-2 mt-2"><span>Production Company:</span><b class="block break-words">{{ $show->production_companies[0]->name }}</b></p>
            </div>
            <div class="relative w-full max-w-2xl aspect-video mt-5">
                @if (isset($chosenVid))
                    <iframe
                        class="absolute top-0 left-0 w-full h-full rounded-lg"
                        src="{{ $chosenVid ? 'https://www.youtube.com/embed/' . $chosenVid->key : '' }}"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                @else
                    <p>Sorry! we couldn't find a trailer for this show.</p>
                    <p>Take this cat instead: <b>ᓚᘏᗢ</b></p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

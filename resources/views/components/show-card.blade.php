<div class="relative w-60 text-textbase group hover:text-white hover:scale-105 transition-all shadow-xl hover:shadow-clickable hover:shadow-2xl duration-200 rounded-md cursor-pointer">
    @if (isset($poster))
        <img src="https://image.tmdb.org/t/p/w300{{ $poster }}" alt="{{ $name }}" class="block bg-black h-90 w-full rounded-md" />
    @else
        <img src="/images/missingcover.png" alt="{{ $name }}" class="block bg-black h-90 w-full rounded-md" />
    @endif

    <!-- Overlay: always present, content can be dynamic -->
    <div class="w-full absolute inset-0 flex flex-col backdrop-blur-xl backdrop-brightness-30 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-md">
        <h3 class="text-lg font-bold mb-2 w-full p-2 truncate">{{ $name }}</h3>
        <p class="pl-2 truncate">Rating: {{number_format($rating, 1)}} <i class="fa-solid fa-star"></i></p>
        <p class="pl-2 truncate">Original Language: {{ strtoupper($originalLanguage) }}</p>
        <p class="pl-2 truncate">Released: {{ date('Y F', strtotime($releaseDate)); }}</p>
        <p class="pl-2 pt-2 truncate">Genres:</p>
        @php
             $genreSerive = app(\App\Services\GenreService::class);
             $genres = $genreSerive->getGenreNames($genreIds);
        @endphp
        <ul class="pl-8">
            @foreach ($genres as $genre)
                <li class="list-disc">{{$genre}}</li>
            @endforeach
        </ul>
    </div>

    <p class="transition-all pl-0.5 text-nowrap truncate mt-2">{{$name}}</p>
</div onclick="window.location.href='{{  route('home', ['id' => $id]) }}'">

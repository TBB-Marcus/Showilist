
<div class="w-60 text-textbase hover:text-white hover:scale-105 transition-allall shadow-xl hover:shadow-clickable hover:shadow-2xl duration-200 rounded-md">
    @if (isset($poster))
        <img src="https://image.tmdb.org/t/p/w300{{ $poster }}" alt="{{ $name }}" class="hover:opacity-10 transition-all duration-200 bg-black h-90">
    @else
        <img src="/images/missingcover.png" alt="{{ $name }}" class="hover:opacity-10 transition-all duration-200 bg-black h-90">
    @endif
    <p class="transition-all pl-0.5 text-nowrap truncate">{{$name}}</p>
</div>

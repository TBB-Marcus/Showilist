<div class="mt-5">
    <span><i class="fa-solid fa-star text-yellow-500 text-2xl"></i> Rating:</span>
    <select wire:model.live="review" class="border rounded-md w-15 h-10 text-center ml-2">
        @if ($rating != 0)
            <option selected>{{$rating}}</option>
        @endif
        @foreach($range as $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
</div>

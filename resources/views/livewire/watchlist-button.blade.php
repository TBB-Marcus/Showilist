<div class="mt-5">
    <select wire:model.live="status" class="border rounded-md w-50 h-10 text-center">

        <option selected value="">{{ $status === '' ? 'Add to Watchlist' : $statuses[$status] }}</option>

        @foreach($statuses as $key => $label)
            @if ($key !== $status)
                <option value="{{ $key }}">{{ $label }}</option>
            @endif
        @endforeach
        @if ($status !== '')
            <option value="remove">Remove from Watchlist</option>
        @endif
    </select>
</div>

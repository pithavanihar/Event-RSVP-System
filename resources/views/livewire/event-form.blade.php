<div class="container mt-4">
    <h2>{{ $eventId ? 'Edit Event' : 'Create Event' }}</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" wire:model.defer="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input type="date" wire:model.defer="date" class="form-control">
            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Event</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

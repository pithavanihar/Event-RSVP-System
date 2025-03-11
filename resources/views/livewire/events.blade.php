<div class="container mt-5">
    <h2>Upcoming Events</h2>
    <a href="{{ route('event.create') }}" class="btn btn-success mb-3">Create Event</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Attendees</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr wire:key="event-{{ $event->id }}">
                    <td>{{ $event->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                    <td>{{ $event->rsvps()->count() }}
                    <td>
                        @if ($event->isRsvpedBy(auth()->id()))
                            <button wire:click="toggleRsvp({{ $event->id }})" class="btn btn-danger">
                                Cancel RSVP
                            </button>
                        @else
                            <button wire:click="toggleRsvp({{ $event->id }})" class="btn btn-success">
                                RSVP
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $events->links() }}
</div>

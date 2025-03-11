<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use App\Models\EventRsvp as Rsvp;
use Illuminate\Support\Facades\Auth;

class Events extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['rsvpUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.events', [
            'events' => Event::orderBy('date')->paginate(10),
        ])->extends('layouts.app')->section('content');
    }

    public function toggleRsvp($eventId)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $event = Event::findOrFail($eventId);

    if ($event->isRsvpedBy(auth()->id())) {
        Rsvp::where('event_id', $event->id)->where('user_id', auth()->id())->delete();
    } else {
        Rsvp::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id
        ]);
    }
    $this->dispatch('rsvpUpdated');
}

}
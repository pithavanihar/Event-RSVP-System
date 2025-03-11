<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\EventRsvp as Rsvp;
use App\Models\Event;

class EventRsvp extends Component
{
    public $event;
    public $isRsvped = false;

    protected $listeners = ['rsvpUpdated' => '$refresh'];

    public function mount($event)
    {
        $this->event = $event;
        $this->isRsvped = Rsvp::where('event_id', $event->id)->where('user_id', Auth::id())->exists();
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

    public function render()
    {
        return view('livewire.event-rsvp');
    }
}

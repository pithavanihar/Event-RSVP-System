<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventForm extends Component
{
    public $eventId, $name, $date;

    protected $rules = [
        'name' => 'required|min:3',
        'date' => 'required|date|after:today',
    ];

    public function mount($eventId = null)
    {
        if ($eventId) {
            $event = Event::findOrFail($eventId);
            $this->eventId = $event->id;
            $this->name = $event->name;
            $this->date = $event->date->format('Y-m-d');
        }
    }

    public function save()
    {
        $this->validate();

        Event::updateOrCreate(
            ['id' => $this->eventId],
            ['name' => $this->name, 'date' => $this->date]
        );

        session()->flash('success', 'Event created successfully!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.event-form')->extends('layouts.app')->section('content');
    }
}
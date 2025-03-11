<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\User;
use App\Models\EventRsvp as Rsvp;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    public function it_can_create_an_event()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('create-event')
            ->set('name', 'Test Event')
            ->set('date', now()->addDays(3)->toDateString())
            ->call('createEvent')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('events', [
            'name' => 'Test Event',
            'date' => now()->addDays(3)->toDateString()
        ]);
    }

    public function it_shows_validation_errors_when_event_name_is_missing()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('create-event')
            ->set('name', '')
            ->set('date', now()->addDays(3)->toDateString())
            ->call('createEvent')
            ->assertHasErrors(['name' => 'required']);
    }

    public function it_shows_validation_error_when_event_date_is_in_past()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('create-event')
            ->set('name', 'Past Event')
            ->set('date', now()->subDay()->toDateString())
            ->call('createEvent')
            ->assertHasErrors(['date' => 'after']);
    }

    public function authenticated_user_can_rsvp_to_an_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        Livewire::actingAs($user)
            ->test('event-rsvp', ['event' => $event])
            ->call('toggleRsvp')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('rsvps', [
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);
    }

    public function authenticated_user_can_withdraw_rsvp_from_an_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        Rsvp::create([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);

        Livewire::actingAs($user)
            ->test('event-rsvp', ['event' => $event])
            ->call('toggleRsvp')
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('rsvps', [
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);
    }

    public function guests_cannot_rsvp_to_an_event()
    {
        $event = Event::factory()->create();

        Livewire::test('event-rsvp', ['event' => $event])
            ->call('toggleRsvp')
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('rsvps', [
            'event_id' => $event->id
        ]);
    }
}

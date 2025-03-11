<?php

namespace Database\Factories;

use App\Models\EventRsvp as Rsvp;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class RsvpFactory extends Factory
{
    protected $model = Rsvp::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'event_id' => Event::factory()
        ];
    }
}
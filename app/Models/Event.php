<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date'];

    public function rsvps()
    {
        return $this->hasMany(EventRsvp::class);
    }

    public function attendeeCount()
    {
        return $this->rsvps()->count();
    }

    public function isRsvpedBy($userId)
    {
        return $this->rsvps()->where('user_id', $userId)->exists();
    }

}

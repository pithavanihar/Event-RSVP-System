<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventRsvp extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id'];
}

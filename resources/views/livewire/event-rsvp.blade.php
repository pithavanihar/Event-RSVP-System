<button wire:click="toggleRsvp" class="btn {{ $isRsvped ? 'btn-danger' : 'btn-primary' }}">
    {{ $isRsvped ? 'Cancel RSVP' : 'RSVP' }}
</button>


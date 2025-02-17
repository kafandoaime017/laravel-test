<?php

// app/Http/Livewire/UserBookings.php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class UserBookings extends Component
{
    public $bookings;

    public function mount()
    {
        // Récupérer les réservations de l'utilisateur connecté
        $this->bookings = Booking::where('user_id', Auth::id())                                        
        ->get();
    }

    public function render()
    {
        return view('livewire.user-bookings');
    }
}


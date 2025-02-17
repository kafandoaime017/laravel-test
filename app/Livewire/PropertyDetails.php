<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Livewire\BookingManager;

class PropertyDetails extends Component
{
    public $propertyId;
    public $start_date;
    public $end_date;
    public $message;
    public $messageType;
    
    protected $listeners = ['bookingProcessed' => 'handleBookingResponse'];

    protected $rules = [
        'start_date' => 'required|date|after:today',
        'end_date' => 'required|date|after:start_date',
    ];

    protected $messages = [
        'start_date.required' => 'La date d\'arrivée est requise',
        'start_date.after' => 'La date d\'arrivée doit être après aujourd\'hui',
        'end_date.required' => 'La date de départ est requise',
        'end_date.after' => 'La date de départ doit être après la date d\'arrivée',
    ];

    public function mount($propertyId)
    {
        $this->propertyId = $propertyId;
    }

    public function book()
    {
        if (!Auth::check()) {
            $this->message = "Vous devez être connecté pour réserver.";
            $this->messageType = "error";
            return;
        }
        $this->validate();

        $result = BookingManager::bookStatic($this->propertyId, $this->start_date, $this->end_date);

        // Gérer le résultat
        $this->message = $result['message'];
        $this->messageType = $result['status'];

        if ($result['status'] === 'success') {
          
            return redirect()->back();
        }
    }

    public function render()
    {
        $property = Property::findOrFail($this->propertyId);

        return view('livewire.property-details', [
            'property' => $property
        ]);
    }

    public function updatedStartDate($value)
    {
        if ($this->end_date && $value >= $this->end_date) {
            $this->end_date = date('Y-m-d', strtotime($value . ' +1 day'));
        }
    }
}

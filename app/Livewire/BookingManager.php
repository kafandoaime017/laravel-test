<?php
// app/Http/Livewire/BookingManager.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public $propertyId;
    public $start_date;
    public $end_date;
    public $message = '';
    public $user;

    // Validation des dates
    protected $rules = [
        'start_date' => 'required|date|after:today',
        'end_date' => 'required|date|after:start_date',
    ];

    // Méthode statique pour la réservation
    public static function bookStatic($propertyId, $start_date, $end_date)
    {
        $user = Auth::user();
        
        if (!$user) {
            return ['status' => 'error', 'message' => "Vous devez être connecté pour réserver."];
        }

        // Vérification de la disponibilité de la propriété
        $conflict = Booking::where('property_id', $propertyId)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                      ->orWhereBetween('end_date', [$start_date, $end_date])
                      ->orWhere(function ($q) use ($start_date, $end_date) {
                          $q->where('start_date', '<=', $start_date)
                            ->where('end_date', '>=', $end_date);
                      });
            })
            ->exists();

        if ($conflict) {
            return ['status' => 'error', 'message' => "Cette période est déjà réservée."];
        }

        // Création de la réservation
        Booking::create([
            'user_id' => $user->id,
            'property_id' => $propertyId,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $property_=Property::find($propertyId);

        return ['status' => 'success', 'message' => "Réservation réussie du {$start_date} au {$end_date} chez {$property_->name}"];
    }

    // Méthode pour afficher la vue
    public function render()
    {
        return view('livewire.booking-manager');
    }
}

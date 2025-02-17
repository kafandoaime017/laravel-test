<!-- resources/views/livewire/user-bookings.blade.php -->

<div class="p-6 bg-white shadow-sm rounded-lg">
    <h2 class="text-xl font-bold mb-4">Mes réservations</h2>

    @if($bookings->isEmpty())
        <p>Aucune réservation trouvée.</p>
    @else
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Propriété</th>
                    <th class="px-4 py-2 border">Date de début</th>
                    <th class="px-4 py-2 border">Date de fin</th>
                    <th class="px-4 py-2 border">Date de reservation</th>
                    <th class="px-4 py-2 border">Status</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td class="px-4 py-2 border">{{ $booking->property->name }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">Réservé le {{ \Carbon\Carbon::parse($booking->created_at)->translatedFormat('d F Y à H:i') }}</td>
                        <td class="px-4 py-2 border">
                            @if($booking->status === 'pending')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                            @elseif($booking->status === 'confirmed')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Confirmée</span>
                            @elseif($booking->status === 'cancelled')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Annulée</span>
                            @endif
                        </td>


                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

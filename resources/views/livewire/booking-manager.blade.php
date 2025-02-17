<div class="p-4 bg-white shadow-lg rounded-lg">
    <h2 class="text-lg font-bold mb-3">Réserver cette propriété</h2>

    <label for="start_date" class="block text-sm font-medium">Date de début :</label>
    <input type="date" wire:model="start_date" class="border p-2 rounded w-full mb-3">
    @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror

    <label for="end_date" class="block text-sm font-medium">Date de fin :</label>
    <input type="date" wire:model="end_date" class="border p-2 rounded w-full mb-3">
    @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror

    <button wire:click="book" class="px-4 py-2 bg-primary text-white rounded hover:bg-opacity-80">
        Réserver
    </button>

    @if ($message)
        <p class="mt-3 text-green-600">{{ $message }}</p>
    @endif
</div>

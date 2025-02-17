<div class="min-h-screen  py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto mb-8">
            <div>
                <a href="">Proprietés</a>/Details
            </div><br>
            <h1 class="text-4xl font-bold text-gray-900">{{ $property->name }}</h1>
        </div>

        @if ($message)
            <div @class([
                'max-w-6xl mx-auto mb-4 p-4 rounded-lg',
                'bg-red-100 text-red-700' => $messageType === 'error',
                'bg-green-100 text-green-700' => $messageType === 'success',
                'bg-blue-100 text-blue-700' => $messageType === 'info'
            ])>
                {{ $message }}
            </div>
        @endif

        <div class="grid grid-cols-1 px-4 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <p class="text-gray-700 text-center leading-relaxed text-lg">{{ $property->description }}</p>
                    <div class="max-w-3xl mx-auto my-8">
                        <img 
                            src="https://static.vecteezy.com/system/resources/previews/002/172/762/large_2x/house-front-view-illustration-free-vector.jpg" 
                            alt="{{ $property->name }}" 
                            class="w-full h-[400px] object-cover rounded-xl"
                        >
                    </div>
                </div>
            </div>

           
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl p-6 shadow-sm sticky top-4">
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline">
                                <span class="text-3xl font-bold">€{{ number_format($property->price_per_night, 0, ',', ' ') }}</span>
                                <span class="text-gray-500 ml-2">/ nuit</span>
                            </div>
                            
                        </div>
                    </div>

                
                    <form wire:submit.prevent="book" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Arrivée</label>
                                <input 
                                    type="date" 
                                    wire:model="start_date"
                                    min="{{ date('Y-m-d') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                >
                                @error('start_date') 
                                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Départ</label>
                                <input 
                                    type="date" 
                                    wire:model="end_date"
                                    min="{{ $start_date ?? date('Y-m-d') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                >
                                @error('end_date') 
                                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if($start_date && $end_date)
                            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex justify-between text-sm">
                                    <span>Total pour {{ Carbon\Carbon::parse($start_date)->diffInDays(Carbon\Carbon::parse($end_date)) }} nuits</span>
                                    <span class="font-semibold">
                                        €{{ number_format($property->price_per_night * Carbon\Carbon::parse($start_date)->diffInDays(Carbon\Carbon::parse($end_date)), 0, ',', ' ') }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <button 
                            type="submit" 
                            @class([
                                'w-full py-3 px-8 rounded-full text-lg font-semibold transition duration-300',
                                'bg-primary hover:bg-primary-dark text-white'
                                
                            ])>
                            
                           
                                Réserver maintenant
                          
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container lg:px-[100px] mx-auto py-4 px-1">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Liste des Propriétés</h2>
    
    <div class="grid md:grid-cols-4 grid-cols-3 gap-6">
        @foreach($properties as $property)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://static.vecteezy.com/system/resources/previews/002/172/762/large_2x/house-front-view-illustration-free-vector.jpg" class="w-full h-48 object-cover" alt="Property Image">
                <div class="p-4">
                    <h3 class="text-xl font-bold">{{ $property->name }}</h3>
                    <p class="text-gray-600">{{ Str::limit($property->description, 100) }}</p>
                    <p class="text-primary font-semibold mt-2">{{ $property->price_per_night }} €/nuit</p>
                    <a href="{{ url('/properties/'.$property->id) }}" class="text-white hover:bg-black bg-primary px-4 py-2 font-bold mt-2 inline-block">Voir plus →</a>
                </div>
            </div>
        @endforeach
    </div>
    <br> <br>
    {{$properties->links()}}
</div>

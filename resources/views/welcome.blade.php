@extends('layouts.app')

@section('content')
<header class="relative bg-cover py-3 bg-primary bg-center h-[160px] sm:h-[360px] " >
    <div class="absolute p-6 pt-6 inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white">
        @auth
<br><br>
            @if (Auth::user()->role=='admin')
            <h3 class="text-2xl font-light mb-4">Bonjour, administrateur <span class="text-green-500 font-bold">{{Auth::user()->name}}</span> 😊</h3>

                <p>
                    <small>Accedez à votre espace pour gerer les reservations  et les properties</small>
                </p><br>
                <a href="/admin" class="block bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-100"> Tableau de bord</a><br>
                @else
                <h3 class="text-2xl font-light mb-4">Bonjour, <span class="text-green-500 font-bold">{{Auth::user()->name}}</span> 😊</h3>
                <h3 class="text-3xl font-extrabold mb-4">Trouvez votre prochain séjour parfait</h3>
            @endif
        @endauth
        @if (!Auth::check())
        <h3 class="text-3xl font-extrabold mb-4">Trouvez votre prochain séjour parfait</h3>

        @endif
       
    </div>
</header>

<section class="container mx-auto py-16 px-6">
    <div>
        @livewire('properties-list')
    </div>
</section>
@endsection
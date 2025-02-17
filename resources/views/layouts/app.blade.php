<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Booking ')</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

   <!-- Navigation -->
<nav class="bg-white shadow-sm fixed w-full z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <a href="/" class="text-2xl font-bold text-primary">🏡 BookingTest</a>

        <!-- Menu principal -->
        <div class="hidden md:flex items-center space-x-4">
            @auth
                <!-- Dropzone avec icône utilisateur -->
                <div class="relative">
                    <button id="userMenuButton" class="flex items-center space-x-2 bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                        <span>{{ auth()->user()->name }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Menu déroulant -->
                    <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-md hidden">
                        <a href="{{ route('user.bookings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Mes réservations</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"> Mon profil</a>
                        @if (Auth::user()->role=='admin')
                           <a href="/admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"> Tableau de bord</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="block w-full">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Déconnexion</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/login" class="text-gray-700 hover:text-primary">Se connecter</a>
                <a href="/register" class="bg-primary text-white px-4 py-2 rounded-lg">S'inscrire</a>
            @endauth
        </div>

        <!-- Menu hamburger pour mobile -->
        <button id="hamburgerButton" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- Menu mobile -->
    <div id="mobileMenu" class="md:hidden hidden bg-white shadow-md py-4">
        @auth
            <a href="{{ route('user.bookings') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Mes réservations</a>
            <a href="{{ route('profile.edit') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Mon profil</a>
            @if (Auth::user()->role=='admin')
            <a href="/admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"> Tableau de bord</a>
         @endif
            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                @csrf
                <button type="submit" class="w-full text-left px-6 py-2 text-gray-700 hover:bg-gray-100">Déconnexion</button>
            </form>
        @else
            <a href="/login" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Se connecter</a>
            <a href="/register" class="block px-6 py-2 bg-primary text-white rounded-lg mx-6">S'inscrire</a>
        @endauth
    </div>
</nav>

<!-- JavaScript -->
<script>
    // Gestion du menu déroulant utilisateur
    document.getElementById('userMenuButton')?.addEventListener('click', function () {
        document.getElementById('userDropdown').classList.toggle('hidden');
    });

    // Gestion du menu mobile
    document.getElementById('hamburgerButton')?.addEventListener('click', function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });

    // Fermer le menu utilisateur lorsqu'on clique ailleurs
    document.addEventListener('click', function (event) {
        const userMenu = document.getElementById('userDropdown');
        const userButton = document.getElementById('userMenuButton');

        if (!userMenu.contains(event.target) && !userButton.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });
</script>

<br><br><br>

    <main>
        @yield('content')
    </main>
   
 

   

    @livewireScripts
</body>
</html>

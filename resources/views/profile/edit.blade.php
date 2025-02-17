@extends('layouts.app')

@section('content')
<div class="container mx-auto  px-10 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6"> Mon Profil</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Informations personnelles</h3>
        
        <p class="text-gray-700"><strong>Nom:</strong> {{ auth()->user()->name }}</p>
        <p class="text-gray-700"><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p class="text-gray-700"><strong>Inscrit le:</strong> {{ auth()->user()->created_at->translatedFormat('d F Y') }}</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Modifier mes informations</h3>

        @if (session('status'))
            <p class="text-green-500">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-gray-700">Nom</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full p-2 border rounded-lg">
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full p-2 border rounded-lg">
                @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Mettre à jour</button>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Changer mon mot de passe</h3>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Mot de passe actuel</label>
                <input type="password" name="current_password" class="w-full p-2 border rounded-lg">
                @error('current_password') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Nouveau mot de passe</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg">
                @error('password') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Confirmer le nouveau mot de passe</label>
                <input type="password" name="password_confirmation" class="w-full p-2 border rounded-lg">
            </div>

            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Changer le mot de passe</button>
        </form>
    </div>
</div>
@endsection

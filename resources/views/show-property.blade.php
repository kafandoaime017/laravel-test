<!-- resources/views/properties/show.blade.php -->
@extends('layouts.app')

@section('content')
    

    <section class="container mx-auto py-16 px-6">
        <!-- Passer l'ID de la propriété au composant Livewire -->
        @livewire('property-details', ['propertyId' => $propertyId])
    </section>
@endsection

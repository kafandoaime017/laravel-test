<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class PropertiesList extends Component
{
    use WithPagination;
    public function render()
    {
        $properties=Property::paginate(6);
        return view('livewire.properties-list',compact('properties'));
    }
}

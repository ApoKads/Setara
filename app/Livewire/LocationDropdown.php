<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location; // Make sure to import your Location model
use Illuminate\Support\Facades\Request;

class LocationDropdown extends Component
{
    public $isOpen = false;
    public $search = '';
    public $selectedLocation = null;

    protected $listeners = [
        'closeDropdown',
        'selectLocationFromJs' // Listener for event from JavaScript
    ];

    public function mount()
    {
        // Check for 'location' parameter in the URL
        $locationIdFromUrl = Request::query('location');

        if ($locationIdFromUrl) {
            $location = Location::find($locationIdFromUrl);
            if ($location) {
                $this->selectedLocation = [
                    'id' => $location->id,
                    'city' => $location->city,
                ];
            }
        }
    }

    public function render()
    {
        $searchQuery = $this->search;

        $locations = Location::when($searchQuery, function ($query) use ($searchQuery) {
            $query->where('city', 'like', '%' . $searchQuery . '%');
        })
        ->get();

        return view('livewire.location-dropdown', [
            'locations' => $locations,
        ]);
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
        // Optionally, reset search when opening/closing for a cleaner view
        // if (!$this->isOpen) {
        //     $this->search = '';
        // }
    }

    // Method called from JavaScript event
    public function selectLocationFromJs($id, $city)
    {
        $this->selectedLocation = ['id' => $id, 'city' => $city];
        $this->isOpen = false; // Close dropdown after selection
        $this->search = ''; // Reset search bar after selection
        $this->dispatch('locationSelected', $id); // Emit event if needed
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
        $this->search = ''; // Reset search bar when closing dropdown
    }

    // This method can be ignored or removed if no elements directly call it
    public function selectLocation($id, $city)
    {
        // This might not be needed anymore if all selections are via selectLocationFromJs
        $this->selectedLocation = ['id' => $id, 'city' => $city];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('locationSelected', $id);
    }
}
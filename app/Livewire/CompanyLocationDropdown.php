<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;
use Illuminate\Support\Facades\Request;

class CompanyLocationDropdown extends Component
{
    public $isOpen = false;
    public $search = '';
    public $selectedLocation = null;
    public $selectedId = null; // ← Tambahkan ini untuk menerima ID dari blade

    protected $listeners = [
        'closeDropdown',
        'selectLocationFromJs',
    ];

    public function mount()
    {
        // Prioritaskan input dari frontend terlebih dahulu
        if ($this->selectedId) {
            $location = Location::find($this->selectedId);
            if ($location) {
                $this->selectedLocation = [
                    'id' => $location->id,
                    'city' => $location->city,
                ];
                return;
            }
        }

        // Jika tidak ada dari prop, coba cek dari query string URL
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
        })->get();

        return view('livewire.company-location-dropdown', [
            'locations' => $locations,
        ]);
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function selectLocationFromJs($id, $city)
    {
        $this->selectedLocation = ['id' => $id, 'city' => $city];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('locationSelected', $id);
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
        $this->search = '';
    }

    public function selectLocation($id, $city)
    {
        $this->selectedLocation = ['id' => $id, 'city' => $city];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('locationSelected', $id);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EducationLevel; // Make sure to import your EducationLevel model
use Illuminate\Support\Facades\Request;

class EducationLevelDropdown extends Component
{
    public $isOpen = false;
    public $search = '';
    public $selectedEducationLevel = null;

    protected $listeners = [
        'closeDropdown',
        'selectEducationLevelFromJs' // Listener for event from JavaScript
    ];

    public function mount()
    {
        // Check for 'education_level' parameter in the URL
        $educationLevelIdFromUrl = Request::query('education_level');

        if ($educationLevelIdFromUrl) {
            $educationLevel = EducationLevel::find($educationLevelIdFromUrl);
            if ($educationLevel) {
                $this->selectedEducationLevel = [
                    'id' => $educationLevel->id,
                    'name' => $educationLevel->name, // Assuming 'name' column for the education level
                ];
            }
        }
    }

    public function render()
    {
        $searchQuery = $this->search;

        $educationLevels = EducationLevel::when($searchQuery, function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        })
        ->get();

        return view('livewire.education-level-dropdown', [
            'educationLevels' => $educationLevels,
        ]);
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    // Method called from JavaScript event
    public function selectEducationLevelFromJs($id, $name)
    {
        $this->selectedEducationLevel = ['id' => $id, 'name' => $name];
        $this->isOpen = false; // Close dropdown after selection
        $this->search = ''; // Reset search bar after selection
        $this->dispatch('educationLevelSelected', $id); // Emit event if needed
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
        $this->search = ''; // Reset search bar when closing dropdown
    }

    // This method can be ignored or removed if no elements directly call it
    public function selectEducationLevel($id, $name)
    {
        $this->selectedEducationLevel = ['id' => $id, 'name' => $name];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('educationLevelSelected', $id);
    }
}
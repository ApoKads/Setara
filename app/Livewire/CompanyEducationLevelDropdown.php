<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\Request;

class CompanyEducationLevelDropdown extends Component
{
    public $isOpen = false;
    public $search = '';
    public $selectedEducationLevel = null;
    public $selectedId = null; // ← Tambahan agar bisa menerima ID dari Blade

    protected $listeners = [
        'closeDropdown',
        'selectEducationLevelFromJs'
    ];

    public function mount()
    {
        // Prioritaskan selectedId dari komponen
        if ($this->selectedId) {
            $educationLevel = EducationLevel::find($this->selectedId);
            if ($educationLevel) {
                $this->selectedEducationLevel = [
                    'id' => $educationLevel->id,
                    'name' => $educationLevel->name,
                ];
                return;
            }
        }

        // Fallback ke query parameter dari URL jika selectedId tidak ada
        $educationLevelIdFromUrl = Request::query('education_level');
        if ($educationLevelIdFromUrl) {
            $educationLevel = EducationLevel::find($educationLevelIdFromUrl);
            if ($educationLevel) {
                $this->selectedEducationLevel = [
                    'id' => $educationLevel->id,
                    'name' => $educationLevel->name,
                ];
            }
        }
    }

    public function render()
    {
        $searchQuery = $this->search;

        $educationLevels = EducationLevel::when($searchQuery, function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        })->get();

        return view('livewire.company-education-level-dropdown', [
            'educationLevels' => $educationLevels,
        ]);
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function selectEducationLevelFromJs($id, $name)
    {
        $this->selectedEducationLevel = ['id' => $id, 'name' => $name];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('educationLevelSelected', $id);
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
        $this->search = '';
    }

    public function selectEducationLevel($id, $name)
    {
        $this->selectedEducationLevel = ['id' => $id, 'name' => $name];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('educationLevelSelected', $id);
    }
}

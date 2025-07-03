<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobType;
use Illuminate\Support\Facades\Request;

class CompanyJobTypeDropdown extends Component
{
    public $isOpen = false;
    public $search = '';
    public $selectedJobType = null;
    public $selectedId = null; // Tambahkan untuk menerima ID dari luar

    protected $listeners = [
        'closeDropdown',
        'selectJobTypeFromJs',
    ];

    public function mount()
    {
        // Prioritaskan prop dari luar (selectedId)
        if ($this->selectedId) {
            $jobType = JobType::find($this->selectedId);
            if ($jobType) {
                $this->selectedJobType = [
                    'id' => $jobType->id,
                    'name' => $jobType->name,
                ];
                return;
            }
        }

        // Jika tidak ada, fallback ke query string
        $jobTypeIdFromUrl = Request::query('job_type');
        if ($jobTypeIdFromUrl) {
            $jobType = JobType::find($jobTypeIdFromUrl);
            if ($jobType) {
                $this->selectedJobType = [
                    'id' => $jobType->id,
                    'name' => $jobType->name,
                ];
            }
        }
    }

    public function render()
    {
        $searchQuery = $this->search;

        $jobTypes = JobType::when($searchQuery, function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        })->get();

        return view('livewire.company-job-type-dropdown', [
            'jobTypes' => $jobTypes,
        ]);
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function selectJobTypeFromJs($id, $name)
    {
        $this->selectedJobType = ['id' => $id, 'name' => $name];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('jobTypeSelected', $id);
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
        $this->search = '';
    }

    public function selectJobType($id, $name)
    {
        $this->selectedJobType = ['id' => $id, 'name' => $name];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('jobTypeSelected', $id);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobType;
use Illuminate\Support\Facades\Request;

class JobTypeDropdown extends Component
{
    public $isOpen = false;
    public $search = '';
    public $selectedJobType = null;

    protected $listeners = [
        'closeDropdown',
        'selectJobTypeFromJs' // Listener baru untuk event dari JavaScript
    ];

    public function mount()
    {
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
        // Pastikan $search tetap dipertahankan saat render
        $searchQuery = $this->search;

        $jobTypes = JobType::when($searchQuery, function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        })
        ->get();

        return view('livewire.job-type-dropdown', [
            'jobTypes' => $jobTypes,
        ]);
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
        // Opsional: Reset search saat membuka/menutup untuk tampilan yang lebih bersih
        // if (!$this->isOpen) {
        //     $this->search = '';
        // }
    }

    // Metode baru yang dipanggil dari event JavaScript
    public function selectJobTypeFromJs($id, $name)
    {
        $this->selectedJobType = ['id' => $id, 'name' => $name];
        $this->isOpen = false; // Tutup dropdown setelah memilih
        $this->search = ''; // Reset search bar setelah memilih
        $this->dispatch('jobTypeSelected', $id); // Emit event jika perlu
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
        $this->search = ''; // Reset search bar saat menutup dropdown
    }

    // Ini bisa diabaikan atau dihapus jika tidak ada elemen yang langsung memanggilnya
    public function selectJobType($id, $name)
    {
        // Ini mungkin tidak lagi dibutuhkan jika semua pemilihan melalui selectJobTypeFromJs
        $this->selectedJobType = ['id' => $id, 'name' => $name];
        $this->isOpen = false;
        $this->search = '';
        $this->dispatch('jobTypeSelected', $id);
    }
}
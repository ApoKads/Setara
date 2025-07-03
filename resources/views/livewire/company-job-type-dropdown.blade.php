<div class="relative w-full">
    {{-- Trigger Dropdown --}}
    <input type="hidden" name='job_type' value="{{ $selectedJobType['id'] ?? '' }}">
    <div class="text-lg text-[#96b8da] border-[#88BBD8] border-2 h-15 py-2.5 px-4 rounded-2xl cursor-pointer flex justify-between items-center bg-white"
        wire:click="toggleDropdown">
        <span class="{{ !empty($selectedJobType['name']) ? 'text-[#132442]' : 'text-[#96b8da]' }}">
            {{ $selectedJobType['name'] ?? 'Pilih Tipe Pekerjaan' }}
        </span>

        <svg class="h-4 w-4 text-[#88BBD8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>

    {{-- Dropdown Content --}}
    @if ($isOpen)
        <div class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg"
            wire:click.away="closeDropdown">
            {{-- Search Bar --}}
            <div class="p-2 border-b border-gray-200">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari Job Type..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Job Type List --}}
            <div class="max-h-60 overflow-y-auto">
                {{-- Opsi default untuk mengosongkan filter, hanya terlihat saat search kosong --}}
                @if (empty($search))
                    <div class="p-2 cursor-pointer hover:bg-blue-100 {{ empty($selectedJobType['id']) ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectJobTypeFromJs', { id: '', name: 'Pilih Tipe Pekerjaan' })">
                        Pilih Tipe Pekerjaan (Semua)
                    </div>
                @endif

                @forelse ($jobTypes as $jobType)
                    <div class="p-2 cursor-pointer hover:bg-blue-100 {{ ($selectedJobType['id'] ?? null) == $jobType->id ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectJobTypeFromJs', { id: {{ $jobType->id }}, name: '{{ $jobType->name }}' })">
                        {{ $jobType->name }}
                    </div>
                @empty
                    {{-- Pesan kosong lebih kontekstual --}}
                    @if (!empty($search))
                        <div class="p-2 text-gray-500">Tidak ada Tipe Pekerjaan ditemukan untuk "{{ $search }}".
                        </div>
                    @else
                        <div class="p-2 text-gray-500">Tidak ada Tipe Pekerjaan yang tersedia.</div>
                    @endif
                @endforelse
            </div>

        </div>
    @endif
</div>

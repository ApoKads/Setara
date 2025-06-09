<div class="relative w-full">
    {{-- Trigger Dropdown --}}
    <input type="hidden" name='job_type' value="{{ $selectedJobType['id'] ?? '' }}">
    <div
        class=" border-gray-300 border-[1px] py-2.5 px-3 rounded-md cursor-pointer flex justify-between items-center bg-white"
        wire:click="toggleDropdown"
    >
        <span class="text-gray-700">
            {{ $selectedJobType['name'] ?? 'Pilih Job Type' }}
        </span>
        <svg
            class="w-4 h-4 text-gray-500"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"
            ></path>
        </svg>
    </div>

    {{-- Dropdown Content --}}
    @if ($isOpen)
        <div
            class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg"
            wire:click.away="closeDropdown"
        >
            {{-- Search Bar --}}
            <div class="p-2 border-b border-gray-200">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari Job Type..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            {{-- Job Type List --}}
            <div class="max-h-60 overflow-y-auto">
                @forelse ($jobTypes as $jobType)
                    {{-- Perubahan di sini: Menggunakan onclick dan Livewire.dispatch --}}
                    <div
                        class="p-2 cursor-pointer hover:bg-blue-100 {{ ($selectedJobType['id'] ?? null) == $jobType->id ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectJobTypeFromJs', { id: {{ $jobType->id }}, name: '{{ $jobType->name }}' })"
                    >
                        {{ $jobType->name }}
                    </div>
                @empty
                    <div class="p-2 text-gray-500">Tidak ada Job Type ditemukan.</div>
                @endforelse
            </div>
        </div>
    @endif
</div>
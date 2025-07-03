<div class="relative w-full">
    {{-- Trigger Dropdown --}}
    <input type="hidden" name='location' value="{{ $selectedLocation['id'] ?? '' }}">
    <div
        class="text-lg text-[#96b8da] border-[#88BBD8] border-2 h-15 px-4 rounded-2xl cursor-pointer flex justify-between items-center bg-white"
        wire:click="toggleDropdown"
    >
        <span class="{{ !empty($selectedLocation['city']) ? 'text-[#132442]' : 'text-[#96b8da]' }}">
            {{ $selectedLocation['city'] ?? 'Pilih Lokasi' }}
        </span>
        <svg
            class="h-4 w-4 text-[#88BBD8]"
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
            class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg"
            wire:click.away="closeDropdown"
        >
            {{-- Search Bar --}}
            <div class="p-2 border-b border-gray-200">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari Lokasi..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    wire:keydown.enter.prevent
                    wire:keydown.enter.blur
                >
            </div>

            {{-- Location List --}}
            <div class="max-h-60 overflow-y-auto">
                {{-- Default option to clear the filter, only visible when search is empty --}}
                @if (empty($search))
                    <div
                        class="p-2 cursor-pointer hover:bg-blue-100 {{ empty($selectedLocation['id']) ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectLocationFromJs', { id: '', city: 'Pilih Lokasi' })"
                    >
                        Pilih Lokasi (Semua) punya Company
                    </div>
                @endif

                @forelse ($locations as $location)
                    <div
                        class="p-2 cursor-pointer hover:bg-blue-100 {{ ($selectedLocation['id'] ?? null) == $location->id ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectLocationFromJs', { id: {{ $location->id }}, city: '{{ $location->city }}' })"
                    >
                        {{ $location->city }}
                    </div>
                @empty
                    {{-- Show this message only if NO locations are found AND search is not empty --}}
                    @if (!empty($search))
                        <div class="p-2 text-gray-500">Tidak ada Lokasi ditemukan untuk "{{ $search }}".</div>
                    @else
                        {{-- Show this if no locations are present at all (even without search) --}}
                        <div class="p-2 text-gray-500">Tidak ada Lokasi yang tersedia.</div>
                    @endif
                @endforelse
            </div>
        </div>
    @endif
</div>
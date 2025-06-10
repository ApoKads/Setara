<div class="relative w-full">
    {{-- Trigger Dropdown --}}
    <input type="hidden" name='education_level' value="{{ $selectedEducationLevel['id'] ?? '' }}">
    <div
        class="border-black border-[1px] h-12 px-4 rounded-lg cursor-pointer flex justify-between items-center bg-white"
        wire:click="toggleDropdown"
    >
        <span class="text-gray-700">
            {{ $selectedEducationLevel['name'] ?? 'Pilih Jenjang Pendidikan' }}
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
            class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg"
            wire:click.away="closeDropdown"
        >
            {{-- Search Bar --}}
            <div class="p-2 border-b border-gray-200">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari Jenjang Pendidikan..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    wire:keydown.enter.prevent
                    wire:keydown.enter.blur
                >
            </div>

            {{-- Education Level List --}}
            <div class="max-h-60 overflow-y-auto">
                @forelse ($educationLevels as $educationLevel)
                    <div
                        class="p-2 cursor-pointer hover:bg-blue-100 {{ ($selectedEducationLevel['id'] ?? null) == $educationLevel->id ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectEducationLevelFromJs', { id: {{ $educationLevel->id }}, name: '{{ $educationLevel->name }}' })"
                    >
                        {{ $educationLevel->name }}
                    </div>
                @empty
                    <div class="p-2 text-gray-500">Tidak ada Jenjang Pendidikan ditemukan.</div>
                @endforelse
            </div>
        </div>
    @endif
</div>
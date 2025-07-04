<div class="relative w-full">
    {{-- Trigger Dropdown --}}
    <input type="hidden" name='education_level' value="{{ $selectedEducationLevel['id'] ?? '' }}">
    <div
        class="text-lg text-[#96b8da] border-[#88BBD8] border-2 h-15 px-4 rounded-2xl cursor-pointer flex justify-between items-center bg-white"
        wire:click="toggleDropdown"
    >
        <span class="{{ isset($selectedEducationLevel['id']) && $selectedEducationLevel['id'] !== '' ? 'text-[#132442]' : 'text-[#96b8da]' }}">
            {{ $selectedEducationLevel['name'] ?? 'Pilih Jenjang Pendidikan' }}
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
                    placeholder="Cari Jenjang Pendidikan..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    wire:keydown.enter.prevent
                    wire:keydown.enter.blur
                >
            </div>

            {{-- Education Level List --}}
            <div class="max-h-60 overflow-y-auto">
                {{-- Opsi default untuk mengosongkan filter, hanya terlihat saat search kosong --}}
                @if (empty($search))
                    <div
                        class="p-2 cursor-pointer hover:bg-blue-100 {{ empty($selectedEducationLevel['id']) ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectEducationLevelFromJs', { id: '', name: 'Pilih Jenjang Pendidikan' })"
                    >
                        Pilih Jenjang Pendidikan (Semua)
                    </div>
                @endif

                @forelse ($educationLevels as $educationLevel)
                    <div
                        class="p-2 cursor-pointer hover:bg-blue-100 {{ ($selectedEducationLevel['id'] ?? null) == $educationLevel->id ? 'bg-blue-500 text-white' : '' }}"
                        onclick="Livewire.dispatch('selectEducationLevelFromJs', { id: {{ $educationLevel->id }}, name: '{{ $educationLevel->name }}' })"
                    >
                        {{ $educationLevel->name }}
                    </div>
                @empty
                    {{-- Pesan kosong lebih kontekstual --}}
                    @if (!empty($search))
                        <div class="p-2 text-gray-500">Tidak ada Jenjang Pendidikan ditemukan untuk "{{ $search }}".</div>
                    @else
                        <div class="p-2 text-gray-500">Tidak ada Jenjang Pendidikan yang tersedia.</div>
                    @endif
                @endforelse
            </div>
            
        </div>
    @endif
</div>
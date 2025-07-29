<div class="bg-white overflow-hidden shadow-lg rounded-2xl">
    <div class="p-6 md:p-8">
        <div class="flex items-center gap-3">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 rounded-full bg-cyan-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Keahlian</h2>
        </div>
        <hr class="my-4">

        <form action="{{ route('profile.skills.store') }}" method="POST"
            class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            @csrf
            <div class="md:col-span-2">
                <label for="skill_name" class="block text-sm font-medium text-gray-700">Nama Keahlian</label>
                {{-- PERBAIKAN: Mengubah name="name" menjadi name="skill_name" --}}
                <input type="text" name="skill_name" id="skill_name" placeholder="Contoh: Laravel, Photoshop"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
            </div>
            <div>
                <label for="score" class="block text-sm font-medium text-gray-700">Skor (0-100)</label>
                <input type="number" name="score" id="score" min="0" max="100"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
            </div>
            <button type="submit"
                class="md:col-start-3 px-4 py-2 cursor-pointer bg-[#3551A4] text-white rounded-lg hover:bg-blue-800 transition-colors text-sm font-semibold h-10">
                + Tambah Skill
            </button>
        </form>

        <div class="mt-8 space-y-4">
            @forelse ($user->profile->skills as $skill)
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                    <div class="flex-grow pr-4">
                        <span class="font-semibold text-gray-800">{{ $skill->name }}</span>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                            <div class="bg-cyan-500 h-2.5 rounded-full" style="width: {{ $skill->pivot->score }}%"></div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 flex-shrink-0">
                        <span class="text-sm font-bold text-gray-700 w-12 text-right">{{ $skill->pivot->score }}/100</span>

                        <button type="button"
                            onclick="openDeleteConfirmModal('{{ route('profile.skills.destroy', $skill->id) }}')"
                            class="text-gray-400 hover:text-red-500 cursor-pointer transition-colors" title="Hapus Skill">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">Belum ada keahlian.</p>
            @endforelse
        </div>
    </div>
</div>
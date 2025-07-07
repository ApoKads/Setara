<div class="bg-white overflow-hidden shadow-lg rounded-2xl p-6 md:p-8">
    <h2 class="text-2xl font-bold text-gray-800">Keahlian</h2>
    <hr class="my-4">

    {{-- Form Tambah Skill --}}
    <form action="{{ route('profile.skills.store') }}" method="POST"
        class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        @csrf
        <div class="md:col-span-2">
            <label for="skill_id" class="block text-sm font-medium text-gray-700">Pilih Keahlian</label>
            <select name="skill_id" id="skill_id"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
                <option value="" disabled selected>-- Pilih dari daftar --</option>
                @foreach ($allSkills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="score" class="block text-sm font-medium text-gray-700">Skor (0-100)</label>
            <input type="number" name="score" id="score" min="0" max="100"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
        </div>
        <button type="submit"
            class="md:col-start-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold h-10">
            + Tambah Skill
        </button>
    </form>

    {{-- Daftar Skill yang dimiliki --}}
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
                    <form action="{{ route('profile.skills.destroy', $skill) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus skill ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors"
                            title="Hapus Skill">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-4">Belum ada keahlian.</p>
        @endforelse
    </div>
</div>
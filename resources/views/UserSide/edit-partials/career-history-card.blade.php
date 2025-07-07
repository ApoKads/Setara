<div x-data="{ addModal: false, editModal: false, selectedHistory: {} }"
    class="bg-white overflow-hidden shadow-lg rounded-2xl">
    <div class="p-6 md:p-8">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Pekerjaan</h2>
            <button @click="addModal = true; selectedHistory = {}"
                class="px-4 py-2 bg-[#3551A4] text-white rounded-lg hover:bg-blue-800 transition-colors text-sm font-semibold">
                + Tambah Riwayat
            </button>
        </div>
        <hr class="my-4">

        {{-- Daftar Riwayat --}}
        <div class="space-y-4">
            @forelse ($user->profile->careerHistories as $history)
                <div class="border rounded-lg p-4 flex justify-between items-start hover:bg-gray-50">
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">{{ $history->job_title }}</h3>
                        <p class="text-md text-gray-700">{{ $history->company_name }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ \Carbon\Carbon::parse($history->start_date)->isoFormat('MMMM YYYY') }} -
                            {{ $history->end_date ? \Carbon\Carbon::parse($history->end_date)->isoFormat('MMMM YYYY') : 'Sekarang' }}
                        </p>
                    </div>
                    <div class="flex space-x-3 flex-shrink-0 ml-4">
                        {{-- Memastikan data terisi saat modal edit dibuka --}}
                        <button @click="editModal = true; selectedHistory = {{ $history->toJson() }}"
                            class="text-sm font-medium text-yellow-600 hover:text-yellow-800">Edit</button>
                        <form action="{{ route('career-histories.destroy', $history) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">Belum ada riwayat pekerjaan.</p>
            @endforelse
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div x-show="addModal" @keydown.escape.window="addModal = false"
        class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center"
        x-cloak>
        <div @click.away="addModal = false"
            class="relative mx-auto p-6 md:p-8 border w-full max-w-2xl shadow-2xl rounded-2xl bg-white">
            <h3 class="text-xl leading-6 font-bold text-gray-900">Tambah Riwayat Pekerjaan</h3>
            <form action="{{ route('career-histories.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                {{-- PERBAIKAN: Menggunakan path yang benar dan konsisten --}}
                @include('UserSide.edit-partials.career-history-form')
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <button @click="addModal = false" type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg text-sm font-semibold">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-[#3551A4] text-white rounded-lg text-sm font-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div x-show="editModal" @keydown.escape.window="editModal = false"
        class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center"
        x-cloak>
        <div @click.away="editModal = false"
            class="relative mx-auto p-6 md:p-8 border w-full max-w-2xl shadow-2xl rounded-2xl bg-white">
            <h3 class="text-xl leading-6 font-bold text-gray-900">Edit Riwayat Pekerjaan</h3>
            <form :action="`/career-histories/${selectedHistory?.id}`" method="POST" class="mt-4 space-y-4">
                @csrf @method('PUT')
                {{-- PERBAIKAN: Menggunakan path yang benar dan konsisten --}}
                @include('UserSide.edit-partials.career-history-form')
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <button @click="editModal = false" type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg text-sm font-semibold">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg text-sm font-semibold">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div x-data="{ addModal: false, editModal: false, selectedHistory: {} }"
    class="bg-white overflow-hidden shadow-lg rounded-2xl">
    <div class="p-6 md:p-8">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Pekerjaan</h2>
            <button @click="addModal = true; selectedHistory = {}"
                class="cursor-pointer px-4 py-2 bg-[#3551A4] text-white rounded-lg hover:bg-blue-800 transition-colors text-sm font-semibold">
                + Tambah Riwayat
            </button>
        </div>
        <hr class="my-4">

        <div class="space-y-4">
            @forelse ($user->profile->careerHistories as $history)
                <div class="border rounded-lg p-4 flex items-start hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex-shrink-0 mr-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-lg text-gray-900">{{ $history->job_title }}</h3>
                                <p class="text-md text-gray-700">{{ $history->company_name }}</p>
                            </div>
                            <div class="flex space-x-3 flex-shrink-0 ml-4">
                                <button @click="editModal = true; selectedHistory = {{ $history->toJson() }}"
                                    class="text-sm font-medium text-yellow-600 hover:text-yellow-800 cursor-pointer">Edit</button>

                                <button type="button"
                                    onclick="openDeleteConfirmModal('{{ route('career-histories.destroy', $history->id) }}')"
                                    class="text-sm font-medium text-red-600 hover:text-red-800 cursor-pointer">Hapus</button>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ \Carbon\Carbon::parse($history->start_date)->isoFormat('MMMM Y') }} -
                            {{ $history->end_date ? \Carbon\Carbon::parse($history->end_date)->isoFormat('MMMM Y') : 'Sekarang' }}
                        </p>
                        <p class="mt-2 text-gray-600 text-sm">{{ $history->description }}</p>
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
                @include('UserSide.edit-partials.career-history-form')
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <button @click="addModal = false" type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg text-sm font-semibold cursor-pointer">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-[#3551A4] text-white rounded-lg text-sm font-semibold cursor-pointer">Simpan</button>
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
                @csrf
                @method('PUT')
                @include('UserSide.edit-partials.career-history-form')
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <button @click="editModal = false" type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg text-sm font-semibold cursor-pointer">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg text-sm font-semibold cursor-pointer">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
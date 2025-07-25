<x-layout>
    <x-slot:title>
        Track Lamaran
    </x-slot:title>

    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <div class="mb-6">
            <a href="{{ route('profile.show') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Profil
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Status Lamaran Pekerjaan Anda</h1>

        <div x-data="{ activeTab: 'pending' }" class="bg-white rounded-xl shadow-lg p-6">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button @click="activeTab = 'pending'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'pending', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'pending' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Menunggu Persetujuan ({{ $pendingApplicants->count() }})
                    </button>
                    <button @click="activeTab = 'accepted'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'accepted', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'accepted' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Diterima ({{ $acceptedApplicants->count() }})
                    </button>
                    <button @click="activeTab = 'rejected'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'rejected', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'rejected' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Ditolak ({{ $rejectedApplicants->count() }})
                    </button>
                    <button @click="activeTab = 'history'"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'history', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'history' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Riwayat Lamaran ({{ $historyApplicants->count() }})
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="mt-6">
                <!-- Menunggu Persetujuan Tab -->
                <div x-show="activeTab === 'pending'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Lamaran Menunggu Persetujuan</h2>
                    @if($pendingApplicants->isEmpty())
                        <p class="text-gray-600">Tidak ada lamaran yang sedang menunggu persetujuan.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pendingApplicants as $applicant)
                                <div class="bg-gray-50 rounded-lg p-4 shadow-sm border border-gray-200">
                                    <h3 class="font-semibold text-lg text-gray-900">{{ $applicant->job->name }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $applicant->job->company->name }}</p>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                        <span class="text-gray-500 text-xs">Diajukan:
                                            {{ $applicant->created_at->format('d M Y') }}</span>
                                    </div>
                                    <a href="{{ route('job.show', $applicant->job->id) }}"
                                        class="mt-3 inline-block text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat
                                        Detail Pekerjaan</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Diterima Tab -->
                <div x-show="activeTab === 'accepted'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Lamaran Diterima</h2>
                    @if($acceptedApplicants->isEmpty())
                        <p class="text-gray-600">Tidak ada lamaran yang telah diterima.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($acceptedApplicants as $applicant)
                                <div class="bg-green-50 rounded-lg p-4 shadow-sm border border-green-200">
                                    <h3 class="font-semibold text-lg text-gray-900">{{ $applicant->job->name }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $applicant->job->company->name }}</p>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            Diterima
                                        </span>
                                        <span class="text-gray-500 text-xs">Diajukan:
                                            {{ $applicant->created_at->format('d M Y') }}</span>
                                    </div>
                                    <a href="{{ route('job.show', $applicant->job->id) }}"
                                        class="mt-3 inline-block text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat
                                        Detail Pekerjaan</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Ditolak Tab -->
                <div x-show="activeTab === 'rejected'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Lamaran Ditolak</h2>
                    @if($rejectedApplicants->isEmpty())
                        <p class="text-gray-600">Tidak ada lamaran yang telah ditolak.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($rejectedApplicants as $applicant)
                                <div class="bg-red-50 rounded-lg p-4 shadow-sm border border-red-200">
                                    <h3 class="font-semibold text-lg text-gray-900">{{ $applicant->job->name }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $applicant->job->company->name }}</p>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                        <span class="text-gray-500 text-xs">Diajukan:
                                            {{ $applicant->created_at->format('d M Y') }}</span>
                                    </div>
                                    <a href="{{ route('job.show', $applicant->job->id) }}"
                                        class="mt-3 inline-block text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat
                                        Detail Pekerjaan</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Riwayat Lamaran Tab -->
                <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Lamaran (Diterima & Ditolak)</h2>
                    @if($historyApplicants->isEmpty())
                        <p class="text-gray-600">Tidak ada riwayat lamaran.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                                <thead class="bg-gray-200 text-gray-700">
                                    <tr>
                                        <th class="py-3 px-4 text-left">Posisi Pekerjaan</th>
                                        <th class="py-3 px-4 text-left">Perusahaan</th>
                                        <th class="py-3 px-4 text-left">Status</th>
                                        <th class="py-3 px-4 text-left">Tanggal Diajukan</th>
                                        <th class="py-3 px-4 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($historyApplicants as $applicant)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-4">{{ $applicant->job->name }}</td>
                                            <td class="py-3 px-4">{{ $applicant->job->company->name }}</td>
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                        @if($applicant->status === 'accepted') bg-green-100 text-green-800
                                                        @elseif($applicant->status === 'rejected') bg-red-100 text-red-800
                                                            @else bg-gray-100 text-gray-800
                                                        @endif">
                                                    {{ ucfirst($applicant->status) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">{{ $applicant->created_at->format('d M Y') }}</td>
                                            <td class="py-3 px-4">
                                                <a href="{{ route('job.show', $applicant->job->id) }}"
                                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat
                                                    Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
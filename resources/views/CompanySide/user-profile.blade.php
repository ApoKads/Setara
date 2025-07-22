<x-layout>
    <x-slot:title>
        Profil: {{ $user->profile->name }}
    </x-slot:title>

    <div class="bg-slate-50 font-sans">
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-[#3551A4] text-white p-8 md:p-12 rounded-2xl shadow-xl">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    {{-- Kolom Kiri: Info Teks --}}
                    <div class="w-full md:w-2/3 text-center md:text-left">
                        <h2 class="text-4xl lg:text-5xl font-bold leading-tight">
                            Halo Pelamar!,<br />
                            Saya <span class="text-cyan-400">{{ $user->profile->name }}</span>
                        </h2>
                        <p class="text-xl text-blue-200 mt-2">{{ $user->profile->job_status }}</p>
                        <p class="text-blue-200 mt-4 text-lg italic">
                            "{{ $user->profile->quote ?? 'Tuliskan kutipan atau deskripsi singkat yang menarik tentang diri Anda di sini.' }}"
                        </p>
                        <div class="flex items-center justify-center md:justify-start gap-5 mt-8">
                            {{-- Mail --}}
                            <a href="mailto:{{ $user->email }}"
                                class="text-blue-300 hover:text-white transition-colors" title="Mail">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z">
                                    </path>
                                </svg>
                            </a>
                            {{-- Facebook --}}
                            <a href="#" class="text-blue-300 hover:text-white transition-colors" title="Facebook">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            {{-- Instagram --}}
                            <a href="#" class="text-blue-300 hover:text-white transition-colors"
                                title="Instagram">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8c1.99 0 3.6-1.61 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 1 1-2.5 0 1.25 1.25 0 0 1 2.5 0M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z">
                                    </path>
                                </svg>
                            </a>
                            {{-- LinkedIn --}}
                            <a href="#" class="text-blue-300 hover:text-white transition-colors" title="LinkedIn">
                                <svg class="w-5 h-5 " fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    {{-- Kolom Kanan: Foto & Kartu Kontak --}}
                    <div class="w-full md:w-1/3 flex flex-col items-center mt-8 md:mt-0">
                        <img src="{{ $user->profile->image_url }}" alt="Profile Image"
                            class="w-48 h-48 rounded-full object-cover border-4 border-cyan-400 shadow-2xl">
                        <div
                            class="bg-black bg-opacity-25 p-4 rounded-lg mt-[-40px] w-64 text-center backdrop-blur-sm shadow-lg">
                            <div class="flex items-center justify-center text-sm font-semibold text-gray-200">
                                <span class="w-2.5 h-2.5 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                                AVAILABLE FOR HIRE
                            </div>
                            <a href="#"
                                class="block bg-cyan-400 text-black font-bold py-2.5 px-6 rounded-lg mt-3 hover:bg-cyan-300 transition-colors duration-300 text-sm">
                                CONTACT ME
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-between items-end gap-4">
                <div class="flex flex-col w-60 justify-center items-center gap-2">
                    <div class="">
                        <h1 class="font-bold">Status Lamaran</h1>
                    </div>
                    <div
                        class="w-40 h-10 rounded-lg flex justify-center items-center {{ $applicant->status === 'accepted' ? 'bg-green-400' : ($applicant->status === 'rejected' ? 'bg-red-400' : 'bg-yellow-400') }}">
                        <h1 class="text-sm tracking-wider text-black font-bold uppercase">
                            {{ $applicant->status }}
                        </h1>
                    </div>
                </div>

                <div class="flex gap-4">

                    <a href="javascript:void(0)" onclick="openDecisionModal('reject')"
                        class="inline-block bg-red-400 text-black font-bold py-3 px-8 rounded-lg text-sm tracking-wider hover:bg-red-600 transition-colors">
                        TOLAK LAMARAN
                    </a>
                    <a href="javascript:void(0)" onclick="openDecisionModal('accept')"
                        class="inline-block bg-green-400 text-black font-bold py-3 px-8 rounded-lg text-sm tracking-wider hover:bg-green-600 transition-colors">
                        TERIMA LAMARAN
                    </a>
                </div>

            </div>
        </div>

        {{-- BAGIAN ABOUT --}}
        <div class="relative py-20 sm:py-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <h2 class="absolute inset-x-0 text-center text-8xl opacity-40 md:text-9xl lg:text-[180px] [font-family:var(--font-overpass)] font-extrabold text-gray-200/80 z-0 pointer-events-none select-none"
                    style="background: linear-gradient(to right, #ECE8DC 0%, #3551A4 100% ); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
                    ABOUT
                </h2>
                <div class="relative z-20 text-center">
                    <h3 class="text-4xl sm:text-5xl font-bold text-gray-900">Kenali saya lebih dalam!</h3>
                    <div class="max-w-3xl mx-auto mt-8 text-lg text-gray-600 space-y-6">
                        <p>{{ $user->profile->description ?? 'Deskripsi mendalam tentang diri Anda akan tampil di sini. Anda bisa mengaturnya di halaman edit profile.' }}
                        </p>
                    </div>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-y-10 gap-x-6 mt-16 max-w-5xl mx-auto">
                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A11.953 11.953 0 0112 16.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12a8.959 8.959 0 01-2.284-5.253" />
                                </svg>
                            </div>
                            <p class="mt-3 font-semibold text-gray-800">Dari Indonesia</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0l-2.178-1.31m19.836 1.31l2.178-1.31m0 0a59.914 59.914 0 00-9.562-4.42l-1.157-2.132a1.125 1.125 0 00-1.99 0L9.562 5.174a59.914 59.914 0 00-9.562 4.42z" />
                                </svg>
                            </div>
                            {{-- Ini akan menampilkan teks dinamis --}}
                            <p class="mt-3 font-semibold text-gray-800">Pernah bekerja di {{ $lastCareerString }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="mt-3 font-semibold text-gray-800">Akun Terverifikasi</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="mt-3 font-semibold text-gray-800">{{ $user->profile->job_status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/3 flex justify-center">
                    <img src="{{ $user->profile->image_url }}" alt="Profile Image"
                        class="rounded-2xl shadow-xl w-full max-w-xs object-cover">
                </div>
                <div class="w-full md:w-2/3">
                    <h3 class="text-4xl font-bold text-gray-900 mb-6">Skills & Experiences</h3>
                    <div class="space-y-5">
                        @forelse ($user->profile->skills as $skill)
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-base font-medium text-gray-700">{{ $skill->name }}</span>
                                    <span
                                        class="text-sm font-medium text-gray-700">{{ $skill->pivot->score }}/100</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-gradient-to-r from-cyan-400 to-blue-500 h-2.5 rounded-full"
                                        style="width: {{ $skill->pivot->score }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada keahlian yang ditambahkan. Silakan tambahkan di halaman
                                edit
                                profile.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#0B153D] text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-4xl font-bold text-center mb-12">Career & Education History</h3>
                <div class="max-w-3xl mx-auto">
                    @forelse ($user->profile->careerHistories as $history)
                        <div class="relative pl-8 sm:pl-10 py-6 group">
                            <div class="absolute top-0 left-0 h-full w-0.5 bg-blue-400/30 group-last:h-1/2"></div>
                            <div
                                class="absolute top-8 left-[-5px] sm:left-[-7px] w-4 h-4 bg-cyan-400 rounded-full border-4 border-[#0B153D]">
                            </div>

                            <p class="text-sm text-cyan-300 mb-1">
                                {{ \Carbon\Carbon::parse($history->start_date)->isoFormat('MMMM YYYY') }} -
                                {{ $history->end_date ? \Carbon\Carbon::parse($history->end_date)->isoFormat('MMMM YYYY') : 'Sekarang' }}
                            </p>
                            <h4 class="text-xl font-bold">{{ $history->job_title }}</h4>
                            <p class="text-blue-200">{{ $history->company_name }}</p>
                            <p class="mt-2 text-gray-400 text-sm">{{ $history->description }}</p>
                        </div>
                    @empty
                        <p class="text-center text-gray-400">Belum ada riwayat karir yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Terima / Tolak Lamaran -->
    <div id="decisionModal" class="fixed inset-0 z-50 hidden items-center justify-center h-full w-full">
        <div class="absolute w-full h-full bg-black opacity-40"></div>
        <div id="modalBox" class="bg-white rounded-lg p-6 w-[400px] z-50 relative transition-all duration-300">
            <div class="flex flex-col gap-4">
                <h2 class="text-xl font-bold" id="decisionTitle">Konfirmasi</h2>
                <p id="decisionMessage" class="text-gray-600">Apakah Anda yakin dengan tindakan ini?</p>
                <div class="flex justify-end gap-4 mt-4">
                    <button onclick="closeDecisionModal()"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:brightness-95 transition duration-200 hover:cursor-pointer">
                        Batal
                    </button>
                    <form id="decisionForm" method="POST">
                        @csrf
                        @method('POST')
                        <button id="decisionButton"
                            class="px-4 py-2 text-white font-semibold rounded-lg hover:brightness-95 transition duration-200 cursor-pointer">
                            Konfirmasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>





</x-layout>

<script>
    function openDecisionModal(type) {
        const modal = document.getElementById('decisionModal');
        const title = document.getElementById('decisionTitle');
        const message = document.getElementById('decisionMessage');
        const button = document.getElementById('decisionButton');
        const box = document.getElementById('modalBox');
        const form = document.getElementById('decisionForm');

        const applicantId = "{{ $applicant->id }}";
        // Show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // Reset all color-related classes
        button.className = 'px-4 py-2 text-white font-semibold rounded-lg hover:brightness-95 transition duration-200';
        box.className = 'rounded-lg p-6 w-[400px] z-50 relative transition-all duration-300';

        if (type === 'accept') {
            title.textContent = 'Terima Lamaran';
            message.textContent = 'Apakah Anda yakin ingin menerima lamaran ini?';
            button.textContent = 'Terima';

            button.classList.add('bg-green-500');
            box.classList.add('bg-green-50');
            form.action = `/company/dashboard/applicant/${applicantId}/accept`;
        } else if (type === 'reject') {
            title.textContent = 'Tolak Lamaran';
            message.textContent = 'Apakah Anda yakin ingin menolak lamaran ini?';
            button.textContent = 'Tolak';

            button.classList.add('bg-red-500');
            box.classList.add('bg-red-50');
            form.action = `/company/dashboard/applicant/${applicantId}/reject`;
        }
    }

    function closeDecisionModal() {
        const modal = document.getElementById('decisionModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>

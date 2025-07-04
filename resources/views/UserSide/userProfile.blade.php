<x-layout title="Profile">
    <x-slot:title>{{ 'Profile' }}</x-slot>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-[#3551A4] text-white p-8 md:p-12 rounded-2xl shadow-xl font-sans">
            <!-- Kontainer utama dengan layout flex -->
            <div class="flex flex-col md:flex-row items-center gap-8">

                <!-- Kolom Kiri: Teks Informasi -->
                <div class="w-full md:w-2/3 text-center md:text-left">
                    <h2 class="text-4xl lg:text-5xl font-bold leading-tight">
                        Halo Pelamar!,<br />
                        Saya <span class="text-cyan-400">{{ $user->profile->name }}</span>,
                        {{ $user->profile->job_status }}
                    </h2>
                    <p class="text-blue-200 mt-4 text-lg italic">
                        "{{ $user->profile->quote ?? 'Tuliskan kutipan atau deskripsi singkat yang menarik tentang diri Anda di sini.' }}"
                    </p>

                    <p class="mt-2 text-white">{{ $user->profile->about ?? 'Deskripsi Singkat' }}</p>

                    <!-- Ikon Social Media & Tombol CV -->
                    <div class="flex items-center justify-center md:justify-start gap-6 mt-8">
                        <!-- Ganti '#' dengan link sosial media Anda -->
                        <a href="#" class="hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M21.5 2.5h-19A2.5 2.5 0 000 5v14a2.5 2.5 0 002.5 2.5h19a2.5 2.5 0 002.5-2.5V5a2.5 2.5 0 00-2.5-2.5zM8 18H5V9h3v9zM6.5 7.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zM18 18h-3v-4.25c0-1.01-.02-2.31-1.4-2.31-1.4 0-1.62 1.1-1.62 2.23V18h-3V9h2.88v1.32h.04c.4-.76 1.37-1.55 2.84-1.55 3.04 0 3.6 2 3.6 4.6V18z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.32 9.625c.015.16.025.32.025.485 0 4.96-3.775 10.68-10.68 10.68-2.12 0-4.09-.62-5.75-1.68.3 0 .6.02.89.02 1.76 0 3.37-.6 4.65-1.6-1.65-.03-3.04-1.12-3.52-2.61.23.04.46.06.7.06.34 0 .68-.05 1-.13-1.72-.35-3.01-1.87-3.01-3.7V7.8c.5.28 1.08.45 1.68.46-1-.67-1.66-1.8-1.66-3.07 0-.68.18-1.32.5-1.88 1.85 2.26 4.6 3.75 7.65 3.88-.06-.28-.1-.56-.1-.85 0-2.06 1.67-3.73 3.73-3.73.93 0 1.77.39 2.36 1.02.73-.14 1.43-.41 2.06-.78-.24.75-.75 1.38-1.42 1.78.65-.08 1.28-.25 1.86-.51-.43.64-.97 1.2-1.6 1.66z" />
                            </svg>
                        </a>
                        <a href="#" class="hover:text-cyan-400 transition-colors">
                            <!-- Ganti dengan ikon Instagram atau lainnya jika perlu -->
                        </a>

                        <!-- Tombol Download CV -->
                        <!-- <a href="#"
                            class="ml-auto border border-white rounded-full px-6 py-2 text-sm font-semibold hover:bg-white hover:text-blue-800 transition-all duration-300">
                            DOWNLOAD CV
                        </a> -->
                    </div>
                </div>

                <!-- Kolom Kanan: Foto & Kartu Kontak -->
                <div class="w-full md:w-1/3 flex flex-col items-center mt-8 md:mt-0">
                    <img src="{{ $user->profile->profile_image ? asset('storage/profile_images/' . $user->profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->profile->name) . '&color=7F9CF5&background=EBF4FF' }}"
                        alt="Profile Image"
                        class="w-48 h-48 rounded-full object-cover border-4 border-cyan-400 shadow-2xl">

                    <!-- Kartu Kontak -->
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

        <!-- Tombol "Track Lamaranmu" di luar kartu utama -->
        <div class="my-6">
            <a href="#"
                class="inline-block bg-yellow-300 text-black font-bold py-3 px-8 rounded-lg text-sm tracking-wider hover:bg-yellow-400 transition-colors">
                TRACK LAMARANMU!
            </a>
        </div>


        <div class="relative bg-slate-50 py-20 sm:py-24 overflow-hidden">

            <div
                class="absolute hidden lg:block top-3/4 left-24 transform -translate-y-1/2 [font-family:var(--font-overpass)] -rotate-90 origin-bottom-left z-10">
                <p class="text-7xl font-bold text-slate-200 tracking-widest whitespace-nowrap">
                    {{ strtoupper($user->profile->name) }}
                </p>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <h2 class="absolute inset-x-0 text-center text-8xl opacity-40 md:text-9xl lg:text-[180px] [font-family:var(--font-overpass)] font-extrabold text-gray-200/80 z-0 pointer-events-none select-none "
                    style="background: linear-gradient(to right, #ECE8DC 0%, #3551A4 100% ); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
                    ABOUT
                </h2>

                <div class="relative z-20 text-center">
                    <h3 class="text-4xl sm:text-5xl font-bold text-gray-900">
                        Kenali saya lebih dalam!
                    </h3>

                    <div class="max-w-3xl mx-auto mt-8 text-lg text-gray-600 space-y-6">
                        <p>{{ $user->profile->description ?? 'Tuliskan deskripsi yang lebih mendalam di sini. Anda juga bisa mengeditnya di form profil.' }}
                        </p>
                    </div>

                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-y-10 gap-x-6 mt-16 max-w-5xl mx-auto">

                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A11.953 11.953 0 0112 16.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12a8.959 8.959 0 01-2.284-5.253" />
                                </svg>
                            </div>
                            <p class="mt-3 font-semibold text-gray-800">Dari Tembilahan</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0l-2.178-1.31m19.836 1.31l2.178-1.31m0 0a59.914 59.914 0 00-9.562-4.42l-1.157-2.132a1.125 1.125 0 00-1.99 0L9.562 5.174a59.914 59.914 0 00-9.562 4.42z" />
                                </svg>
                            </div>
                            <p class="mt-3 font-semibold text-gray-800">Alumni dari Bina Nusantara</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="mt-3 font-semibold text-gray-800">Akun Terverifikasi</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <div
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-cyan-100 text-cyan-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="mt-3 font-semibold text-gray-800">Siap Untuk Bekerja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-3/4 text-center md:text-left md:pl-8">
                    <h2 class="text-3xl font-semibold text-gray-800">
                        Halo pelamar!,<br />saya <span class="text-blue-600">{{ $user->profile->name }},</span>
                    </h2>
                    <p class="text-xl text-gray-600 mt-2">
                        {{ $user->profile->job_status }}
                    </p>
                    @if($user->profile->quote)
                        <p class="text-lg text-gray-500 mt-4 italic">"{{ $user->profile->quote }}"</p>
                    @endif
                </div>

                <div class="w-full md:w-1/4 flex justify-center mb-4 md:mb-0">
                    <img src="{{ $user->profile->profile_image ? asset('storage/profile_images/' . $user->profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->profile->name) . '&color=7F9CF5&background=EBF4FF' }}"
                        alt="Profile Image" class="w-36 h-36 rounded-full object-cover shadow-lg border-4 border-white">
                </div>
            </div>

            <hr class="my-6">

            <div>
                <h3 class="text-xl font-semibold text-gray-800">Tentang Saya:</h3>
                <p class="mt-2 text-gray-700">{{ $user->profile->about ?? 'Deskripsi Singkat' }}</p>
                <p class="mt-2 text-gray-600"><strong>Usia:</strong> {{ $user->profile->age ?? 'N/A' }} tahun</p>
            </div>

            <hr class="my-6">

            <div>
                <h3 class="text-xl font-semibold text-gray-800">Kenali saya lebih dalam:</h3>
                <p class="mt-2 text-gray-700">{{ $user->profile->description ?? 'Deskripsi Panjang' }}</p>
            </div>
        </div>

        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-gray-800 border-b pb-4">Edit Profile Anda</h3>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->profile->name) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="job_status" class="block text-sm font-medium text-gray-700">Status
                                Pekerjaan</label>
                            <input type="text" id="job_status" name="job_status"
                                value="{{ old('job_status', $user->profile->job_status) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('job_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="age" class="block text-sm font-medium text-gray-700">Usia</label>
                            <input type="number" id="age" name="age" value="{{ old('age', $user->profile->age) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <div class="mb-4">
                            <label for="quote" class="block text-sm font-medium text-gray-700">Kutipan / Motto</label>
                            <input type="text" id="quote" name="quote" value="{{ old('quote', $user->profile->quote) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('quote') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="profile_image" class="block text-sm font-medium text-gray-700">Ganti Foto Profil
                                (Opsional)</label>
                            <input type="file" name="profile_image" id="profile_image"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('profile_image') <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="about" class="block text-sm font-medium text-gray-700">Tentang Saya</label>
                    <textarea id="about" name="about" rows="4"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">{{ old('about', $user->profile->about) }}</textarea>
                    @error('about') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Saya</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">{{ old('description', $user->profile->description) }}</textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>


        @if($user->profile->careerHistories->count() > 0)
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800">Riwayat Karir</h3>
                <ul class="mt-4 space-y-4 divide-y divide-gray-200">
                    @foreach($user->profile->careerHistories as $history)
                        <li class="pt-4 first:pt-0">
                            <h4 class="font-medium text-lg text-gray-800">{{ $history->job_title }} di {{ $history->company }}
                            </h4>
                            <p class="text-sm text-gray-600">({{ \Carbon\Carbon::parse($history->start_date)->format('F Y') }} -
                                {{ $history->end_date ? \Carbon\Carbon::parse($history->end_date)->format('F Y') : 'Sekarang' }})
                            </p>
                            <p class="text-gray-700 mt-2">{{ $history->job_description }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-layout>
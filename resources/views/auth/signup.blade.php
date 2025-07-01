<x-layout title="Sign Up">
    {{-- PERUBAHAN: Mengganti font-sans menjadi font-poppins --}}
    <section class="font-poppins">
        <div class="container px-5 py-8 mx-auto flex flex-wrap items-center min-h-screen">

            {{-- Kolom Kiri: Form Registrasi dengan UI Baru --}}
            <div class="lg:w-2/5 md:w-1/2 w-full mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">

                    {{-- Header --}}
                    <div class="text-center mb-6">
                        <h1
                            class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl font-[var(--font-overpass)]">
                            WELCOME TO SETARA!
                        </h1>
                        <p class="text-sm font-light text-gray-500 mt-2">
                            Are you a Company?
                            {{-- PERUBAHAN: Mengubah warna teks link --}}
                            <a href="#" class="font-medium text-[#88BBD8] hover:underline">Sign Up
                                Here!</a>
                        </p>
                    </div>

                    {{-- Form --}}
                    <form class="space-y-4" action="{{ route('signup') }}" method="POST">
                        @csrf

                        {{-- Full Name --}}
                        <div>
                            {{-- PERUBAHAN: Mengubah warna teks label --}}
                            <label for="name" class="block mb-2 text-sm font-medium text-[#444B59]">Full Name</label>
                            {{-- PERUBAHAN: Mengubah warna focus ring dan border --}}
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-[#88BBD8] focus:border-[#88BBD8] block w-full p-3"
                                placeholder="Your Full Name" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            {{-- PERUBAHAN: Mengubah warna teks label --}}
                            <label for="email" class="block mb-2 text-sm font-medium text-[#444B59]">Email</label>
                            {{-- PERUBAHAN: Mengubah warna focus ring dan border --}}
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-[#88BBD8] focus:border-[#88BBD8] block w-full p-3"
                                placeholder="YourEmail@mail.com" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="relative">
                            {{-- PERUBAHAN: Mengubah warna teks label --}}
                            <label for="password" class="block mb-2 text-sm font-medium text-[#444B59]">Password</label>
                            {{-- PERUBAHAN: Mengubah warna focus ring dan border --}}
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-[#88BBD8] focus:border-[#88BBD8] block w-full p-3"
                                placeholder="••••••••" required>
                            <button type="button" id="toggle-button-password" onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 top-7 pr-3 flex items-center text-gray-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="relative">
                            {{-- PERUBAHAN: Mengubah warna teks label --}}
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-[#444B59]">Confirm Password</label>
                            {{-- PERUBAHAN: Mengubah warna focus ring dan border --}}
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-[#88BBD8] focus:border-[#88BBD8] block w-full p-3"
                                placeholder="••••••••" required>
                            <button type="button" id="toggle-button-password_confirmation"
                                onclick="togglePassword('password_confirmation')"
                                class="absolute inset-y-0 right-0 top-7 pr-3 flex items-center text-gray-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>

                        {{-- PERUBAHAN: Mengubah warna tombol dan focus ring-nya --}}
                        <button type="submit"
                            class="w-full text-white bg-[#132442] hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-[#88BBD8]/50 font-medium rounded-xl text-sm px-5 py-3 text-center">
                            Sign Up
                        </button>
                    </form>
                </div>
            </div>

            {{-- Kolom Kanan: Gambar Ilustrasi --}}
            <div class="lg:w-3/5 md:w-1/2 hidden lg:flex items-center justify-center">
                <img src="{{ asset('images/login_setara.png') }}" alt="Ilustrasi Halaman Pendaftaran Setara"
                    class="w-full h-auto max-w-lg">
            </div>

        </div>
    </section>

    {{-- Script untuk Show/Hide Password (TIDAK ADA PERUBAHAN FUNGSIONALITAS) --}}
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const toggleButton = document.getElementById('toggle    -button-' + id);
            const eyeIconHTML = `<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>`;
            const eyeSlashIconHTML = `<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.774 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243a3 3 0 01-4.243-4.243" /></svg>`;

            if (input.type === "password") {
                input.type = "text";
                toggleButton.innerHTML = eyeSlashIconHTML;
            } else {
                input.type = "password";
                toggleButton.innerHTML = eyeIconHTML;
            }
        }
    </script>
</x-layout>
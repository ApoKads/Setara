<x-layout title="Sign Up">
    <x-slot:title>Sign Up</x-slot>

        <section class="font-poppins">
            <div class="container py-8 mx-auto flex flex-wrap items-center min-h-screen">

                <div class="lg:w-4/9 w-full mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">

                        {{-- Header --}}
                        <div class="text-center mb-6">
                            <h1
                                class="text-2xl leading-tight tracking-tight font-bold text-gray-900 md:text-3xl [font-family:var(--font-overpass)]">
                                Together, Let’s make accessibility a priority!
                            </h1>
                            <p class="text-sm font-light text-gray-500 mt-2">
                                Are you an applicant?
                                <a href="/signup" class="font-medium text-[#88BBD8] hover:underline">Sign Up
                                    Here!</a>
                            </p>
                        </div>

                        {{-- Form --}}
                        <form class="space-y-4" action="{{ route('signup') }}" method="POST">
                            @csrf
                            <input type="hidden" name="role" value="company">
                            {{-- Full Name (Company Name) --}}
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-[#444B59]">Company
                                    Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-[#88BBD8] focus:border-[#88BBD8] block w-full p-3"
                                    placeholder="Your Company Name" required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-[#444B59]">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-xl focus:ring-[#88BBD8] focus:border-[#88BBD8] block w-full p-3"
                                    placeholder="YourEmail@mail.com" required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="relative">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-[#444B59]">Password</label>
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
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-[#444B59]">Confirm Password</label>
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

                            <button type="submit"
                                class="w-full hover:scale-[102%] transition-transform text-white bg-[#132442] hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-[#88BBD8]/50 font-medium rounded-xl text-sm px-5 py-3 text-center cursor-pointer">
                                Sign Up
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:w-5/9 md:hidden lg:flex items-center justify-center pl-10">
                    <img src="{{ asset('images/login_setara.png') }}" alt="Ilustrasi Halaman Pendaftaran Setara"
                        class="w-full h-auto max-w-lg">
                </div>

            </div>
        </section>

        {{-- Modal Pop-up Konfirmasi --}}
        <div id="confirmationModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-2xl shadow-xl p-8 max-w-lg w-full text-center relative">
                {{-- Close Button (Optional, bisa dihilangkan jika hanya untuk informasi) --}}
                {{-- <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button> --}}

                <h2 class="text-3xl font-bold text-[#132442] mb-6">Thank You for Signing Up!</h2>
                {{-- Menggunakan gambar protect_disability.png --}}
                <img src="{{ asset('images/Homepage/protect_disability.png') }}" alt="Ilustrasi Tangan Bersatu"
                    class="mx-auto mb-6 w-full max-w-xs h-auto">

                <p class="text-lg text-gray-700 mb-8">
                    Untuk menyelesaikan verifikasi, silakan hubungi kami di sini
                </p>

                <div class="flex flex-col items-center gap-4">
                    {{-- Logo Setara --}}
                    <div class="border border-gray-300 rounded-lg p-4 flex flex-col items-center shadow-sm">
                        {{-- Menggunakan gambar setara_slogan.png --}}
                        <img src="{{ asset('images/Homepage/setara_slogan.png') }}" alt="Setara Logo"
                            class="w-32 h-auto mb-2">
                        <h3 class="text-xl font-semibold text-[#132442] mb-4">Contact Us</h3>
                        <div class="flex justify-center gap-4 text-gray-600">
                            <a href="mailto:info@setara.com" class="hover:text-[#132442] transition-colors">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z">
                                    </path>
                                </svg>
                            </a>
                            <a href="tel:+628123456789" class="hover:text-[#132442] transition-colors">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.47.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#" class="hover:text-[#132442] transition-colors">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-[#132442] transition-colors">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8c1.99 0 3.6-1.61 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 1 1-2.5 0 1.25 1.25 0 0 1 2.5 0M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10m0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Loading Indicator --}}
                    <div class="mt-6 flex flex-col items-center">
                        <p class="text-gray-500 text-lg mb-2">Waiting...</p>
                        <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-b-4 border-[#132442]"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                const toggleButton = document.getElementById('toggle-button-' + id);
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

            // JavaScript untuk menampilkan modal
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('confirmationModal');
                // const closeModalButton = document.getElementById('closeModal'); // Jika Anda ingin tombol close

                // Cek apakah ada session flash 'status' dengan nilai 'pending_approval'
                @if (session('status') === 'pending_approval')
                    modal.classList.remove('hidden');
                @endif

            // Event listener untuk tombol close (jika ada)
            // if (closeModalButton) {
            //     closeModalButton.addEventListener('click', function() {
            //         modal.classList.add('hidden');
            //     });
            // }

            // Opsional: Sembunyikan modal jika di-klik di luar area modal
            // modal.addEventListener('click', function(event) {
            //     if (event.target === modal) {
            //         modal.classList.add('hidden');
            //     }
            // });
        });
        </script>
</x-layout>
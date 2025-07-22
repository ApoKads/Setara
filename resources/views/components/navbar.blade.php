<nav class="bg-white border-b border-gray-200 z-[5000000000]">
    <div class="px-4 sm:px-6 lg:px-8 shadow-red-500">
        <div class="flex justify-between items-center h-24">
            <div class="">
                <a href="{{ route('home') }}" class="flex items-center">
                    <div class="h-max w-24">
                        <img src="{{ asset('images/Navbar/Setara-logo.svg') }}" alt="Logo" class="object-cover">
                    </div>
                </a>
            </div>

            <div class="h-max w-fit flex space-x-4">
                <div class="flex items-baseline space-x-2 text-lg">
                    {{-- Navigasi Umum --}}
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'bg-slate-200 text-black font-medium' : 'bg-white text-gray-700 hover:bg-slate-200 hover:text-black'}} px-5 py-2 transition-all duration-300 ease-in-out rounded-3xl text-center">
                        Beranda
                    </a>
                    <a href="{{ route('jobs') }}"
                        class="{{ request()->routeIs('jobs') ? 'bg-slate-200 text-black font-medium' : 'bg-white text-gray-700 hover:bg-slate-200 hover:text-black'}} px-5 py-2 transition-all duration-300 ease-in-out rounded-3xl text-center">
                        Lowongan
                    </a>
                    <a href="{{ route('companies') }}"
                        class="{{ request()->routeIs('companies') ? 'bg-slate-200 text-black font-medium' : 'bg-white text-gray-700 hover:bg-slate-200 hover:text-black'}} px-5 py-2 transition-all duration-300 ease-in-out rounded-3xl text-center">
                        Perusahaan
                    </a>
                </div>

                @auth
                    {{-- Bagian Profile (jika user login) --}}
                    <div class="flex justify-center items-center h-max {{ request()->routeIs('profile.show') ? 'bg-slate-200 text-black font-medium' : 'bg-white text-gray-700 hover:bg-slate-200 hover:text-black'}} transition-all duration-300 ease-in-out rounded-3xl text-center text-lg">
                        <a href="{{ route('profile.show') }}" class="flex justify-center items-center rounded-3xl {{ request()->routeIs('profile.show') ? 'text-black font-medium' : 'text-gray-700 hover:bg-slate-200 hover:text-black'}}">
                            <div class="pl-2">
                                <img src="{{ Auth::user()->profile->image_url ?? asset('images/Navbar/pfp-temp.png') }}" alt="User Icon" class="h-8 w-8 object-cover rounded-full">
                            </div>
                            <p class="pl-2 pr-5 py-2 cursor-pointer mb-0">
                                Profil
                            </p>
                        </a>
                    </div>
                @endauth

                @guest
                    {{-- Tombol Login/Sign Up (user BELUM login) --}}
                    <div class="flex items-center space-x-2 text-lg">
                        <a href="{{ route('login') }}"
                            class="px-5 py-2 bg-white text-gray-700 hover:bg-slate-200 hover:text-black transition-all duration-300 ease-in-out rounded-3xl text-center">
                            Login
                        </a>
                        <a href="{{ route('signup.user.form') }}"
                            class="px-5 py-2 bg-[#132442] text-white font-medium rounded-3xl hover:bg-[#0B182E] transition-all duration-300 ease-in-out text-center">
                            Sign Up
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
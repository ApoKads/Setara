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
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'bg-slate-200 text-black font-medium' : 'bg-white text-gray-700 hover:bg-slate-200 hover:text-black'}} px-5 py-2 transition-all duration-300 ease-in-out rounded-3xl text-center">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.activity') }}"
                        class="{{ request()->routeIs('admin.activity') ? 'bg-slate-200 text-black font-medium' : 'bg-white text-gray-700 hover:bg-slate-200 hover:text-black'}} px-5 py-2 transition-all duration-300 ease-in-out rounded-3xl text-center">
                        Activity
                    </a>
                </div>

                {{-- Bagian Profile (jika user login) --}}
                <form action="{{ route('logout') }}" method="POST" class="inline-flex items-center">
                    @csrf
                    <button type="submit"
                        class="px-5 py-2 text-lg bg-red-500 text-white font-medium rounded-3xl hover:bg-red-700 transition-all duration-300 ease-in-out text-center cursor-pointer">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
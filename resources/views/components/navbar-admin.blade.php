<nav class="bg-white border-b border-gray-200 z-[5000000000]">
    <div class="px-4 sm:px-6 lg:px-8 shadow-red-500">
        <div class="flex justify-between items-center h-24">
            <!-- Logo -->
            <div>
                <a href="{{ route('home') }}" class="flex items-center">
                    <div class="h-max w-24">
                        <img src="{{ asset('images/Navbar/Setara-logo.svg') }}" alt="Logo" class="object-cover">
                    </div>
                </a>
            </div>

            <!-- Navigasi -->
            <div class="h-max w-fit flex space-x-4">
                <div class="flex items-baseline space-x-2 text-lg">
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-5 py-2 rounded-3xl text-center transition-all duration-300 ease-in-out
                        {{ request()->routeIs('admin.dashboard') 
                            ? 'bg-slate-200 text-black font-medium' 
                            : '!bg-white !text-gray-700 hover:!bg-slate-200 hover:!text-black' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.activity') }}"
                        class="px-5 py-2 rounded-3xl text-center transition-all duration-300 ease-in-out
                        {{ request()->routeIs('admin.activity') 
                            ? 'bg-slate-200 text-black font-medium' 
                            : '!bg-white !text-gray-700 hover:!bg-slate-200 hover:!text-black' }}">
                        Aktivitas
                    </a>
                </div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="inline-flex items-center">
                    @csrf
                    <button type="submit"
                        class="px-5 py-2 text-lg rounded-3xl text-center cursor-pointer font-medium 
                        !bg-red-500 !text-white hover:!bg-red-700 transition-all duration-300 ease-in-out">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

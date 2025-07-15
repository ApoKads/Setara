<x-layout-company>
    <x-slot:title>{{ 'Dashboard Company' }}</x-slot>


    {{-- Background --}}
    <div class="absolute z-10 w-full h-full top-0 flex flex-col justify-between overflow-hidden">
        <img src="{{ asset('images/CompanyDashboard/ParallaxAtas.png') }}" alt="Company Logo "
            class="absolute -right-36 -top-40">
        <img src="{{ asset('images/CompanyDashboard/ParallaxBawah.png') }}" alt="Company Logo "
            class="absolute -left-40 -top-4">

    </div>

    @if (session('message'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="fixed bottom-6 right-6 z-50 bg-white shadow-lg rounded-md p-4 w-80 flex items-start gap-3
             {{ session('status') === 'Rejected' ? 'border-l-4 border-red-500' : 'border-l-4 border-green-500' }}">

            {{-- Icon --}}
            <div>
                @if (session('status') === 'Rejected')
                    <svg class="w-6 h-6 text-red-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                @else
                    <svg class="w-6 h-6 text-green-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                @endif
            </div>

            {{-- Message --}}
            <div class="flex-1 text-sm text-gray-800">
                {{ session('message') }}
            </div>

            {{-- Close button --}}
            <button @click="show = false" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    {{-- Content --}}
    <div class="w-full flex justify-center items-center font-pop relative z-20">
        <div class="w-[90%] flex flex-col mt-10 gap-4">

            <div>
                <h1 class="font-bold text-5xl mb-4 text-[#132442]">History Lamaran</h1>
            </div>
            <hr class="border-[1.5px] border-[#132442]">

            {{-- Search Bar --}}
            <div class="w-full p-4 px-8 flex flex-col">
                <form action="" method="GET" class="flex items-center gap-4 w-[70%]">

                    {{-- Sort Dropdown --}}
                    <div class="relative w-1/5 border-gray-300 border-[1px] rounded-lg h-10">
                        <select onchange="this.form.submit()" name="sort"
                            class="block appearance-none w-full text-base text-[#3551A4] h-full px-4 font-medium bg-white border border-gray-300 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:cursor-pointer">
                            <option value="">Urutkan</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-4 h-4 text-[#3551A4]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    {{-- Status Dropdown --}}
                    <div class="relative w-1/5 border-gray-300 border-[1px] rounded-lg h-10">
                        <select onchange="this.form.submit()" name="status"
                            class="block appearance-none w-full text-base text-[#3551A4] h-full px-4 font-medium bg-white border border-gray-300 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:cursor-pointer">
                            <option value="">Status</option>
                            <option value="Accepted" {{ request('status') === 'Accepted' ? 'selected' : '' }}>Accepted
                            </option>
                            <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-4 h-4 text-[#3551A4]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    {{-- Search Bar --}}
                    <div class="w-3/5 border-gray-300 border-[1px] rounded-lg  h-10">
                        <input type="text" name="search" placeholder="Cari Nama Lowongan ..."
                            class="w-full border text-base h-full bg-white px-4 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ request('search') }}">
                    </div>
                </form>


                {{-- Table --}}
                <div class="w-full flex flex-col justify-center items-center gap-2 mt-20">
                    {{-- header --}}
                    <div class="w-full grid grid-cols-[3fr_3fr_2fr_2fr_2fr_2fr] gap-4 text-[#878790]">
                        <div class="flex justify-start  items-center w-full px-4">
                            <h1>Nama Lowongan</h1>
                        </div>
                        <div class="flex justify-center  items-center w-full px-4">
                            <h1>Nama Pelamar</h1>
                        </div>
                        <div class="flex justify-center  items-center w-full">
                            <h1 class="text-[15px]">Tanggal Pendaftaran</h1>
                        </div>
                        <div class="flex justify-center  items-center w-full">
                            <h1 class="text-[15px]">Tanggal Respon</h1>
                        </div>

                        <div class="flex justify-center  items-center w-full">
                            <h1>Status</h1>
                        </div>
                        <div class="flex justify-center items-center w-full">
                            <h1>Kontrol</h1>
                        </div>
                        <div class="flex justify-start  items-center w-full">
                            {{-- <h1>Icon</h1> --}}
                        </div>
                    </div>

                    {{-- content --}}

                    <div class="w-full flex flex-col gap-4">
                        @forelse ($applicants as $applicant)
                            <x-company-dashboard.history-row :applicant="$applicant"></x-company-dashboard.history-row>
                        @empty
                            <p class="w-full text-center p-4">
                                No jobs available ...
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="h-20 w-10"></div>



</x-layout-company>

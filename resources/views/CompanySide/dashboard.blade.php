<x-layout-company>
  <x-slot:title>{{"Dashboard Company"}}</x-slot>
  

  {{-- Background --}}
    <div class="absolute z-10 w-full h-full top-0 flex flex-col justify-between overflow-hidden">
        <img src="{{ asset('images/CompanyDashboard/ParallaxAtas.png' ) }}" alt="Company Logo " class="absolute -right-36 -top-40">
        <img src="{{ asset('images/CompanyDashboard/ParallaxBawah.png' ) }}" alt="Company Logo " class="absolute -left-40 -top-4">
        
    </div>

    {{-- Content --}}
    <div class="w-full flex justify-center items-center font-pop relative z-20">
        <div class="w-[90%] flex flex-col mt-10 gap-4">

            <div>
                <h1 class="font-bold text-5xl mb-4 text-[#132442]">Daftar Lowongan</h1>
            </div>
            <hr class="border-[1.5px] border-[#132442]">

            {{-- Search Bar --}}
            <div class="w-full p-4 px-8 flex flex-col">
                <form action="" method="GET" class="flex items-center w-[50%] gap-4">
                    
                    <div class="relative w-1/4 border-gray-300 border-[1px] rounded-lg h-10">
                        <select onchange="this.form.submit()" name="sort"
                                class="block appearance-none w-full text-base text-[#3551A4] h-full px-4 font-medium bg-white border border-gray-300 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:cursor-pointer">
                            <option value="">Sort by</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                            
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg
                                class="w-4 h-4 text-[#3551A4]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </div>
                    </div>


                    <div class="w-3/4 border-gray-300 border-[1px] rounded-lg  h-10 ">
                        <input type="text"
                            name="search"
                            placeholder="Cari Pekerjaan Impianmu ..."
                            class="w-full border text-base h-full bg-white px-4 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ request('search') }}">
                    </div>
                </form>

                {{-- Table --}}
                <div class="w-full flex flex-col justify-center items-center gap-2 mt-20">
                    {{-- header --}}
                    <div class="w-full grid grid-cols-[5fr_2fr_2fr_1fr_2fr_2fr] gap-4 text-[#878790]">
                        <div class="flex justify-start  items-center w-full px-4">
                            <h1>Lowongan</h1>
                        </div>
                        <div class="flex justify-center  items-center w-full">
                            <h1 class="text-[15px]">Tanggal Pendaftaran</h1>
                        </div>
                        <div>
                                {{-- div kosong buat space antara tanggal dan slot--}}
                        </div>
                        <div class="flex justify-center  items-center w-full">
                            <h1>Slot</h1>
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
                        @forelse ($jobs as $job)
                            <x-company-dashboard.job-row :job="$job"></x-company-dashboard.job-row>
                             <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center h-full w-full">
                                <div class="flex w-full h-full absolute bg-black opacity-30">

                                </div>
                                <div class="bg-white rounded-lg p-6 w-[400px] relative z-10">
                                    <div class="flex flex-col gap-4">
                                        <h2 class="text-xl font-bold text-[#132442]">Konfirmasi Penghapusan</h2>
                                        <p class="text-gray-600">Apakah Anda yakin ingin menghapus lowongan ini?</p>
                                        <div class="flex justify-end gap-4 mt-4">
                                            <button 
                                                onclick="closeDeleteModal()" 
                                                class="px-4 py-2 bg-gray-300 rounded-lg hover:cursor-pointer hover:brightness-95 transition duration-200"
                                            >
                                                Batal
                                            </button>
                                            <form action="/company/dashboard/{{$job->id}}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <button 
                                                    id="confirmDeleteBtn" 
                                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:cursor-pointer hover:brightness-95 transition duration-200"
                                                    >
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <p class="w-full text-center p-4">
                                    No jobs available ...
                                </p>
                        @endforelse                  
                    </div>
                     <a href={{ route('job.create') }} class="bg-white w-10 h-10 flex justify-center items-center rounded-full mb-10 hover:scale-105 hover:brightness-95 hover:cursor-pointer transition duration-200">
                        <p class="font-semibold font-pop text-xl">+</p>
                     </a>
                </div>

            </div>

        </div>
    </div>
   

    <!-- Script untuk Modal -->
    <script>
        let currentJobId = null;

        function openDeleteModal(jobId) {
            currentJobId = jobId;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('flex');
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            currentJobId = null;
        }

    </script>
</x-layout-company>
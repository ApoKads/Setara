<x-layout-company>
    <x-slot:title>{{ 'Dashboard Company' }}</x-slot>
    <div class="w-full px-28 text-[#132442]">

        <div class=" w-full bg-red flex flex-col gap-4 justify-center items-center py-10">
            <h1 class="font-pop font-medium text-xl">Pembukaan Lowongan Kerja</h1>
            {{-- <h1 class="font-pop font-medium text-5xl mx-4 w-1 bg-black flex"></h1> --}}
            <h1 class="font-pop font-medium  text-5xl">{{ $company->name }}</h1>
        </div>
        <hr>

        {{-- Form Section --}}
        <div class="mt-10 px-40 py-10 rounded-lg shadow-lg bg-white">
            <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- General error message at the top --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                        <ul class="mt-3 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-lg font-medium mb-2">Posisi Pekerjaan</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan Posisi Pekerjaan"
                        class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2  w-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="job_type" class="block text-gray-700 text-lg font-medium mb-2">Tipe Pekerjaan</label>
                    <div class="relative w-full rounded-2xl @error('job_type') border-red-500 @enderror">
                        <livewire:company-job-type-dropdown />
                    </div>
                    @error('job_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="education_level" class="block text-gray-700 text-lg font-medium mb-2">Jenjang Pendidikan Minimal</label>
                    <div class="relative w-full rounded-lg @error('education_level') border-red-500 @enderror">
                        <livewire:company-education-level-dropdown />
                    </div>
                    @error('education_level')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="location" class="block text-gray-700 text-lg font-medium mb-2">Lokasi Kerja</label>
                    <div class="relative w-full rounded-lg @error('location') border-red-500 @enderror">
                        <livewire:company-location-dropdown />
                    </div>
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="work_mode" class="block text-gray-700 text-lg font-medium mb-2">Tipe Lokasi Kerja</label>
                    <div class="relative">
                        <select id="work_mode" name="work_mode"
                            class="text-[#96b8da] border-[#88BBD8] block appearance-none w-full bg-white border-2 px-4 py-4 pr-8 rounded-2xl shadow leading-tight focus:outline-none focus:shadow-outline text-lg @error('work_mode') border-red-500 @enderror">
                            <option value="Onsite & Remote" {{ old('work_mode') == 'Onsite & Remote' ? 'selected' : '' }}>Onsite & Remote</option>
                            <option value="Onsite" {{ old('work_mode') == 'Onsite' ? 'selected' : '' }}>Onsite</option>
                            <option value="Remote" {{ old('work_mode') == 'Remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-5 w-5 text-[#88BBD8]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    @error('work_mode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="slot" class="block text-gray-700 text-lg font-medium mb-2">Jumlah Slot Pekerjaan</label>
                    <input type="number" id="slot" name="slot" placeholder="Masukkan Jumlah"
                        class=" placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2 w-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('slot') border-red-500 @enderror"
                        value="{{ old('slot') }}">
                    @error('slot')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-lg font-medium mb-2">Deskripsi Pekerjaan</label>
                    <textarea id="description" name="description" placeholder="Deskripsi Pekerjaan" rows="8"
                        class="placeholder-[#96b8da] border-[#88BBD8] shadow appearance-none border-2 rounded-2xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-none text-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="responsibilities" class="block text-gray-700 text-lg font-medium mb-2">Tanggung Jawab Pekerjaan</label>
                    <textarea id="responsibilities" name="responsibilities" placeholder="Tanggung Jawab Pekerjaan" rows="8"
                        class="placeholder-[#96b8da] border-[#88BBD8] shadow appearance-none border-2 rounded-2xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-none text-lg @error('responsibilities') border-red-500 @enderror">{{ old('responsibilities') }}</textarea>
                    @error('responsibilities')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="wage" class="block text-gray-700 text-lg font-medium mb-2">Rentang Gaji</label>
                    <input type="number" id="wage" name="wage" placeholder="Masukkan Jumlah"
                        class="placeholder-[#96b8da] border-[#88BBD8] shadow appearance-none border-2 rounded-2xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('wage') border-red-500 @enderror"
                        value="{{ old('wage') }}">
                    @error('wage')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="disability" class="block text-gray-700 text-lg font-medium mb-2">Tipe Disabilitas</label>
                    <div class="relative w-full rounded-lg">
                        <select id="disability" name="disability"
                            class="text-[#96b8da] border-[#88BBD8] block appearance-none w-full bg-white border-2 px-4 py-4 pr-8 rounded-2xl shadow leading-tight focus:outline-none focus:shadow-outline text-lg @error('disability') border-red-500 @enderror">
                            <option class=" mb-2 text-black" value="">Tipe Disabilitas</option>
                            @foreach ($disabilities as $dis)
                                <option value="{{ $dis->id }}"
                                    class="text-black"
                                    {{ old('disability') == $dis->id ? 'selected' : '' }}>
                                    {{ $dis->name }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 ">
                            <svg class="fill-current h-6 w-6 text-[#88BBD8]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.757 7.586 5.343 9z" />
                            </svg>
                        </div>
                    </div>
                    @error('disability')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="seniority" class="block text-gray-700 text-lg font-medium mb-2">Level Senioritas</label>
                    <div class="relative w-full rounded-lg">
                        <select id="seniority" name="seniority"
                            class="text-[#96b8da] border-[#88BBD8] block appearance-none  w-full bg-white border-2 px-4 py-4 pr-8 rounded-2xl shadow leading-tight focus:outline-none focus:shadow-outline text-lg @error('seniority') border-red-500 @enderror">
                            <option class=" mb-2 text-black" value="">Pilih Level Senioritas</option>
                            @foreach ($seniorities as $dis)
                                <option class="text-black" value="{{ $dis->id }}"
                                    {{ old('seniority') == $dis->id ? 'selected' : '' }}>
                                    {{ $dis->name }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-6 w-6 text-[#88BBD8]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.757 7.586 5.343 9z" />
                            </svg>
                        </div>
                    </div>
                    @error('seniority')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="banner_image" class="block text-gray-700 text-lg font-medium mb-2">Gambar Banner</label>
                    <input type="file" id="banner_image" name="banner_image"
                        class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2 hover:cursor-pointer hover:bg-blue-50 transition duration-150 w-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('banner_image') border-red-500 @enderror">
                    @error('banner_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-4">
                        <img id="imagePreview" src="#" alt="Preview Gambar" class="hidden max-w-full h-auto rounded-lg shadow-md mt-4"/>
                    </div>

                </div>

                <div class="flex items-center justify-center mt-10">
                    <button type="submit"
                        class="bg-[#132442] text-white font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline text-2xl">
                        Upload Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="h-[100px] w-full"></div>
</x-layout-company>

<script>
    // Fungsi fleksibel untuk mengatur warna teks berdasarkan value
    function updateSelectColor(selectElement) {
        if (selectElement.value === "") {
            selectElement.classList.remove('text-black');
            selectElement.classList.add('text-[#96b8da]');
        } else {
            selectElement.classList.remove('text-[#96b8da]');
            selectElement.classList.add('text-black');
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const selectDisability = document.getElementById('disability');
        const selectSeniority = document.getElementById('seniority');
        const selectWorkMode = document.getElementById('work_mode');
        const inputImage = document.getElementById('banner_image');
        const imagePreview = document.getElementById('imagePreview');

        // Inisialisasi warna text select
        updateSelectColor(selectDisability);
        updateSelectColor(selectSeniority);
        updateSelectColor(selectWorkMode);

        selectDisability.addEventListener("change", () => updateSelectColor(selectDisability));
        selectSeniority.addEventListener("change", () => updateSelectColor(selectSeniority));
        selectWorkMode.addEventListener("change", () => updateSelectColor(selectWorkMode));

        // Event listener untuk preview gambar
        inputImage.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "#";
                imagePreview.classList.add("hidden");
            }
        });
    });
</script>



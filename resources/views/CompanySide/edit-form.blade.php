<x-layout-company>
    <x-slot:title>{{ 'Edit Lowongan Kerja' }}</x-slot>
    <div class="w-full px-28 text-[#132442]">

        <div class=" w-full bg-red flex flex-col gap-4 justify-center items-center py-10">
            <h1 class="font-pop font-medium text-xl">Edit Lowongan Kerja</h1>
            <h1 class="font-pop font-medium text-5xl">{{ $company->name }}</h1>
        </div>
        <hr>

        {{-- Form Section --}}
        <div class="mt-10 px-40 py-10 rounded-lg shadow-lg bg-white">
            {{-- Perhatikan perubahan action ke route update dan penambahan @method('PUT') --}}
            <form action="{{ route('job.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Penting untuk metode PUT/PATCH --}}

                {{-- General error message at the top --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                        role="alert">
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
                        class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2 w-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name', $job->name) }}"> {{-- Menggunakan old() dan $job->name --}}
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="job_type" class="block text-gray-700 text-lg font-medium mb-2">Tipe Pekerjaan</label>
                    <div class="relative w-full rounded-2xl @error('job_type') border-red-500 @enderror">
                        {{-- Meneruskan nilai terpilih ke komponen Livewire --}}
                        <livewire:company-job-type-dropdown :selectedId="$job->job_type_id" />
                    </div>
                    @error('job_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="education_level" class="block text-gray-700 text-lg font-medium mb-2">Jenjang Pendidikan
                        Minimal</label>
                    <div class="relative w-full rounded-lg @error('education_level') border-red-500 @enderror">
                        {{-- Meneruskan nilai terpilih ke komponen Livewire --}}
                        <livewire:company-education-level-dropdown :selectedId="$job->education_level_id" />
                    </div>
                    @error('education_level')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="location" class="block text-gray-700 text-lg font-medium mb-2">Lokasi Kerja</label>
                    <div class="relative w-full rounded-lg @error('location') border-red-500 @enderror">
                        {{-- Meneruskan nilai terpilih ke komponen Livewire --}}
                        {{-- <livewire:location-dropdown :selectedId="$job->location_id" /> --}}
                        <livewire:company-location-dropdown :selectedId="$job->location_id" />
                    </div>
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="work_mode" class="block text-gray-700 text-lg font-medium mb-2">Tipe Lokasi
                        Kerja</label>
                    <div class="relative">
                        <select id="work_mode" name="work_mode"
                            class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl block appearance-none w-full hover:cursor-pointer bg-white border-2 px-4 py-4 pr-8 shadow leading-tight focus:outline-none focus:shadow-outline text-lg @error('work_mode') border-red-500 @enderror">
                            <option value="Onsite & Remote"
                                {{ old('work_mode', $job->work_mode) == 'Onsite & Remote' ? 'selected' : '' }}>Onsite &
                                Remote</option>
                            <option value="Onsite"
                                {{ old('work_mode', $job->work_mode) == 'Onsite' ? 'selected' : '' }}>Onsite</option>
                            <option value="Remote"
                                {{ old('work_mode', $job->work_mode) == 'Remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-5 w-5 text-[#88BBD8]" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    @error('work_mode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="slot" class="block text-gray-700 text-lg font-medium mb-2">Jumlah Slot
                        Pekerjaan</label>
                    <input type="number" id="slot" name="slot" placeholder="Masukkan Jumlah"
                        class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2  w-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('slot') border-red-500 @enderror"
                        value="{{ old('slot', $job->slot) }}">
                    @error('slot')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-lg font-medium mb-2">Deskripsi
                        Pekerjaan</label>
                    <textarea id="description" name="description" placeholder="Deskripsi Pekerjaan" rows="8"
                        class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2 w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-none text-lg @error('description') border-red-500 @enderror">{{ old('description', $job->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="responsibilities" class="block text-gray-700 text-lg font-medium mb-2">Tanggung Jawab
                        Pekerjaan</label>
                    <textarea id="responsibilities" name="responsibilities" placeholder="Tanggung Jawab Pekerjaan" rows="8"
                        class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2 w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-none text-lg @error('responsibilities') border-red-500 @enderror">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                    @error('responsibilities')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="wage" class="block text-gray-700 text-lg font-medium mb-2">Rentang Gaji</label>
                    <input type="number" id="wage" name="wage" placeholder="Masukkan Jumlah"
                        class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2 w-full py-4 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('wage') border-red-500 @enderror"
                        value="{{ old('wage', $job->wage) }}">
                    @error('wage')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="banner_image" class="block text-gray-700 text-lg font-medium mb-2">Gambar Banner</label>

                    <div class="flex flex-col md:flex-row gap-6">
                        {{-- Gambar Lama --}}
                        @if ($job->banner_image_path)
                            <div class="md:w-1/2 w-full">
                                <p class="text-gray-600 text-sm mb-2">Gambar saat ini:</p>
                                <img src="{{ asset($job->banner_image_path) }}" alt="Current Banner"
                                    class="w-full max-h-64 object-cover rounded-lg shadow-md border">
                            </div>
                        @endif

                        {{-- Preview Gambar Baru --}}
                        <div class="md:w-1/2 w-full">
                            <p class="text-gray-600 text-sm mb-2">Preview Gambar Baru:</p>
                            <img id="imagePreview" src="#" alt="Preview Gambar Baru"
                                class="hidden w-full max-h-64 object-cover rounded-lg shadow-md border">
                        </div>
                    </div>

                    <input type="file" id="banner_image" name="banner_image"
                        class="mt-4 placeholder-[#96b8da] border-[#88BBD8] rounded-2xl shadow appearance-none border-2  w-full py-4 hover:cursor-pointer hover:bg-blue-50 transition duration-150 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg @error('banner_image') border-red-500 @enderror">
                    <p class="text-gray-500 text-sm mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    @error('banner_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="disability" class="block text-gray-700 text-lg font-medium mb-2">Tipe
                        Disabilitas</label>
                    <div class="relative w-full rounded-lg">
                        <select id="disability" name="disability"
                            class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl block appearance-none text-black w-full hover:cursor-pointer bg-white border-2 px-4 py-4 pr-8 shadow leading-tight focus:outline-none focus:shadow-outline text-lg @error('disability') border-red-500 @enderror">
                            <option class=" mb-2" value="">Tipe Disabilitas</option>
                            @foreach ($disabilities as $dis)
                                <option value="{{ $dis->id }}"
                                    {{ old('disability', $job->disability_id) == $dis->id ? 'selected' : '' }}>
                                    {{ $dis->name }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-6 w-6 text-[#88BBD8]" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.757 7.586 5.343 9z" />
                            </svg>
                        </div>
                    </div>
                    @error('disability')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="seniority" class="block text-gray-700 text-lg font-medium mb-2">Level
                        Senioritas</label>
                    <div class="relative w-full rounded-lg">
                        <select id="seniority" name="seniority"
                            class="placeholder-[#96b8da] border-[#88BBD8] rounded-2xl block appearance-none text-black w-full hover:cursor-pointer bg-white border-2 px-4 py-4 pr-8 shadow leading-tight focus:outline-none focus:shadow-outline text-lg @error('seniority') border-red-500 @enderror">
                            <option class=" mb-2" value="">Pilih Level Senioritas</option>
                            @foreach ($seniorities as $dis)
                                <option value="{{ $dis->id }}"
                                    {{ old('seniority', $job->seniority_id) == $dis->id ? 'selected' : '' }}>
                                    {{ $dis->name }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-6 w-6 text-[#88BBD8]" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.757 7.586 5.343 9z" />
                            </svg>
                        </div>
                    </div>
                    @error('seniority')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-center mt-10">
                    <button type="submit"
                        class="bg-[#132442] hover:cursor-pointer text-white font-bold py-4 px-8 rounded-lg focus:outline-none focus:shadow-outline text-2xl">
                        Update Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="h-[100px] w-full"></div>
</x-layout-company>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputImage = document.getElementById('banner_image');
        const imagePreview = document.getElementById('imagePreview');

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

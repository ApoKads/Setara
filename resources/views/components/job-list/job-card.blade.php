@props(['card'])
{{-- <a href="" class="block"> --}}

    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-[33rem] w-[26rem] text-[#192F56] flex flex-col justify-between">
                {{-- Gambar logo BCA --}}
                <div>
                    <div class="h-48 flex items-center justify-center bg-red object-cover bg-blue-200">
                        <img src="{{ asset('storage/job/BannerJob.jpeg') }}" alt="Banner Image" class="h-full w-full object-cover">

                        {{-- @if ($card->path_banner)
                            <img src="{{ asset('storage/' . $card->path_banner) }}" alt="BCA Logo" class="h-full w-full object-cover">
                        @else
                            <p>empty</p>
                        @endif --}}
                    </div>

                    <div class="px-5 pb-5 pt-4">

                        {{-- Detail Perusahaan --}}
                        <div class="flex items-center space-x-2 mb-3 font-pop">
                            <img src="{{ asset('storage/company/logoCompany.png' ) }}" alt="Company Logo" class="w-20 h-20 rounded-full border-2 border-gray-200 object-contain">
                            <div class="flex flex-col gap-1">
                                <h3 class="text-sm font-pop font-medium text-[#366FB6]">{{ $card->company->name }}</h3>
                                <h3 class="text-xl font-pop font-medium text-gray-900">{{ Str::limit($card->name,20) }}</h3>
                                <p class="text-sm text-gray-500 flex items-center mt-0.5 -ml-0.5">
                                    <svg class="w-4 h-4 mr-0.5 text-gray-400 font-pop" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                    {{ $card->location->city }}
                                </p>
                            </div>
                        </div>

                        {{-- Kategori / Tags --}}
                        <div class="flex flex-col gap-2 ml-2 mt-4">
                            <div class=" flex flex-wrap gap-2 max-h-[5rem] overflow-hidden relative mb-2">
                                <!-- Tag-tag Anda -->
                                <span class="bg-[#C4DDF6] text-[#132442] text-[14px] font-medium rounded-sm flex px-2 py-1.5">{{ $card->JobType->name }}</span>
                                <span class="bg-[#C4DDF6] text-[#132442] text-[14px] font-medium rounded-sm flex px-2 py-1.5">{{ $card->EducationLevel->name }}</span>
                                <span class="bg-[#C4DDF6] text-[#132442] text-[14px] font-medium rounded-sm flex px-2 py-1.5">{{ $card->work_mode }}</span>
                                <span class="bg-[#C4DDF6] text-[#132442] text-[14px] font-medium rounded-sm flex px-2 py-1.5">{{ $card->seniority->name }}</span>
                            </div>
                            <h1 class="">
                                Jenis Disabilitas : {{ $card->disability->name }}
                            </h1>
                            <h1 class="-mt-1">
                                Batas Pendaftaran : 20 September 2024
                            </h1>
                        </div>
                    </div>
                </div>

            
                <div class="px-5 flex flex-col gap-2 mb-4">
                    <hr class=" bg-[#A5A5A5] border-[0.5px] border-[#A5A5A5]">
                    <div class="ml-2 flex justify-between items-center h-10 ">
                        <div class="flex gap-2 justify-start items-center h-full ">
                            <img src="{{ asset('images/ListJobPage/WageIcon.png') }}" class="w-8" alt="WageIcon">
                            <h1 class="font-semibold">Rp. {{ number_format($card->wage, 0, ',', '.') }}</h1>
                        </div>
                        <a href="{{ route('job.show', $card->slug) }}" class="px-2.5 py-1.5 bg-[#3551A4] text-white rounded-lg">Selengkapnya</a>
                    </div>
                </div>
        
    </div>
{{-- </a> --}}

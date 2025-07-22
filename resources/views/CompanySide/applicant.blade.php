<x-layout-company>
    <x-slot:title>{{ 'List Job' }}</x-slot>


    {{-- SEARCH BAR Section --}}

    {{-- JobCard --}}
   

    <div class="w-full flex justify-center items-center my-10 h-[75px] ">
        <div class="w-[87.5%] flex flex-col justify-center items-center h-full">

            <div class="flex w-full justify-between items-center ">

                <div class="flex h-full items-end">

                    <h1 class="font-pop font-bold text-6xl text-[#132442]">Daftar Pelamar</h1>
                </div>

                <div class="flex h-full items-end text-3xl">
                    <h1>{{ $detail->name }}</h1>

                </div>

            </div>

            <div class="w-full mt-4">
                <hr>
            </div>
        </div>
    </div>

    <div class="w-full flex justify-center mt-10">
        <div class="w-[80%] grid grid-cols-3 gap-4">
            @forelse ($detail->applicant as $applicant)
                <x-applicant-card :applicant="$applicant"></x-applicant-card>
            @empty
                <p>There isn't an applicant for this job yet...</p>
            @endforelse
        </div>
    </div>

    <div class="h-40 w-1"></div>


</x-layout-company>

<x-layout>
    <x-slot:title>{{ 'List Job' }}</x-slot>


    {{-- SEARCH BAR Section --}}

    {{-- JobCard --}}
    @if (session('message'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="
            p-4 rounded-md text-sm font-medium 
            {{ session('status') === 'Rejected' ? 'bg-red-100 border-l-4 border-red-500 text-red-700' : 'bg-green-100 border-l-4 border-green-500 text-green-700' }}"
                role="alert">
                <p>{{ session('message') }}</p>
            </div>
        </div>
    @endif

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


</x-layout>

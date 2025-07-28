@props(['applicant'])

<div class=" flex w-full h-[200px] pt-6 pb-4 bg-white rounded-xl shadow-[0px_0px_4px_1px_rgba(0,0,0,0.25)]">
    <div class="w-[40%] h-[100%]  flex justify-end items-start">
        <div class="h-[7rem] w-[7rem] rounded-full overflow-hidden mr-4 border-[1px] border-black">
            <img src="{{ asset('storage/profile_images/' . $applicant->profile->profile_image) }}" alt="profile"
                class="h-full w-full" style="object-fit: cover">
        </div>
    </div>
    <div class="w-[60%] h-[100%] pr-4">
        <div class="w-full h-[60%] ">

            <h1 class="text-2xl font-pop font-medium">
                {{ $applicant->profile->name }}
            </h1>

            {{-- PERBAIKAN: Menambahkan pengecekan sebelum menampilkan nama disabilitas --}}
            @if($applicant->profile->disabilities->isNotEmpty())
                <h2 class="text-sm font-pop font-light">
                    {{ $applicant->profile->disabilities->first()->name }}
                </h2>
            @endif

        </div>
        <div class="w-full h-[40%] flex justify-end items-center">
            {{-- Added shadow to the <a> tag --}}
                <a href="{{ route('company.applicantDetails', $applicant->id) }}"
                    class="p-2 px-4 text-sm font-pop bg-white rounded-xl text-[#3551A4] shadow-[1px_2px_3px_rgba(70,118,251,0.41)]">See
                    Profile</a>
        </div>
    </div>
</div>
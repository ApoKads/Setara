@props(['job'])
<div class="w-full grid grid-cols-[5fr_2fr_2fr_1fr_2fr_2fr] bg-white gap-2 h-14 rounded-xl drop-shadow-sm">
    <div class="flex justify-start   items-center w-full  px-4">
        <h1>{{ $job->name }}</h1>
    </div>
    <div class="flex justify-center items-center w-full ">
        <h1>{{ $job->created_at->format('d-m-Y') }}</h1>
    </div>

    <div>
        {{-- div kosong buat space antara tanggal dan slot --}}
    </div>

    <div class="flex justify-center items-center w-full ">
        <h1>{{ $job->slot }}</h1>
    </div>
    <div class="flex justify-center items-center w-full ">
        <a href="{{ route('companyJob.show', $job->id) }}"
            class="bg-white p-2 px-4 rounded-lg text-[#3551A4] shadow-[1px_2px_3px_0px_rgba(70,118,251,0.41)] hover:brightness-95 transition duration-200">See
            Details</a>
    </div>
    <div class="flex justify-start items-center w-full gap-4">
        {{-- <h1>Icon</h1> --}}
        <a href="{{ route('job.edit', $job->id) }}"
            class="flex justify-center items-center bg-[#EFEFFE] h-10 w-10 rounded-full hover:brightness-95 hover:cursor-pointer transition duration-200">
            <i class="fa-solid fa-pen text-[#132442]"></i>
        </a>
        <div
            onclick="openDeleteModal({{ $job->id }})"
            class="flex justify-center items-center bg-[#ffd0d0] h-10 w-10 rounded-full hover:brightness-95 hover:cursor-pointer transition duration-200">
            <i class="fa-solid fa-trash text-[#FF0000]"></i>
        </div>
        <div class="group flex justify-end items-center h-10 w-10 hover:cursor-pointer transition duration-200">
            <i
                class="fa-solid fa-ellipsis-vertical text-2xl text-[#b4bcc3] group-hover:text-[#8c949b] transition duration-200"></i>
        </div>
    </div>
</div>

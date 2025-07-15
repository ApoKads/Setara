@props(['applicant'])
<div class="w-full grid grid-cols-[3fr_3fr_2fr_2fr_2fr_2fr] bg-white gap-2 h-14 rounded-xl drop-shadow-sm">
    <div class="flex justify-start   items-center w-full  px-4">
        <h1>{{ $applicant->job->name }} </h1>
    </div>
    <div class="flex justify-center   items-center w-full  px-4">
        <h1>{{ $applicant->profile->name }}</h1>
    </div>
    <div class="flex justify-center items-center w-full ">
        <h1>{{ $applicant->created_at->format('d-m-Y') }}</h1>
    </div>
    <div class="flex justify-center items-center w-full ">
        <h1>{{ $applicant->updated_at->format('d-m-Y') }}</h1>
    </div>

    <div class="flex justify-center items-center w-full">
        <div
            class="h-8 w-28 rounded-md flex items-center justify-center
        {{ $applicant->status === 'Accepted' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
            <h1>{{ $applicant->status ?? 'Unknown' }}</h1>
        </div>
    </div>

    <div class="flex justify-center items-center w-full ">
        <a href="{{ route('company.applicantDetails', $applicant->id) }}"
            class="bg-white p-2 px-4 rounded-lg text-[#3551A4] shadow-[1px_2px_3px_0px_rgba(70,118,251,0.41)] hover:brightness-95 transition duration-200">See
            Details</a>
    </div>
</div>

<x-layout>
    <x-slot:title>{{ 'JobDetail' }}</x-slot>
    <h3 class="text-xl">Job Detail</h3>
    <h1>Job Provider: {{ $detail->company->name }}</h1>
    <h1>Job Name: {{ $detail->name }}</h1>
    <h1>Wage: {{ $detail->wage }}</h1>

    <div class=" w-full flex justify-center">
        <div class="flex w-[80%] ">
            <div class="w-full grid grid-cols-3 gap-x-8 gap-y-4">
                @forelse ($detail->applicant as $applicant)
                    <x-applicant-card :applicant="$applicant"></x-applicant-card>
                @empty
                @endforelse





            </div>

        </div>
    </div>
</x-layout>

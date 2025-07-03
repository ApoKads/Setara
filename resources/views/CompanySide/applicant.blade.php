<x-layout>
  <x-slot:title>{{"List Job"}}</x-slot>


{{-- SEARCH BAR Section --}}

  {{-- JobCard --}}
  <h1>Job Name : {{ $detail->name }}</h1>
  <h1>Wage : {{ $detail->wage }}</h1>
  <h1>Location : {{ $detail->location->city }}</h1>
  
  <div class="w-full flex justify-center mt-10">
        <div class="w-[80%] grid grid-cols-3 gap-4">
            @forelse ($detail->applicant as $applicant)
                <x-applicant-card :applicant="$applicant"></x-applicant-card>
            @empty
                <p>empty...</p>
            @endforelse
        </div>
  </div>
  

</x-layout>
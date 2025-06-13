<x-layout>
  <x-slot:title>{{"List Job"}}</x-slot>


{{-- SEARCH BAR Section --}}
  <x-job-list.search-bar :disabilities="$disabilities" :JobType="$JobType"></x-job-list.search-bar>

  {{-- JobCard --}}
  <div class="w-full flex justify-center">
        <div class="w-[90%] mb-20 flex flex-col justify-center">
            <div class="grid grid-cols-3 w-full gap-12 mt-10 ">
                @forelse ($jobCard as $card)
                    <x-job-list.job-card :card="$card" ></x-job-list.job-card>
                @empty
                    <p>There isn't a job available...</p>
                @endforelse
            </div>
            <div class="flex flex-col justify-center items-center mt-10">
                {{ $jobCard->links() }}
            </div>
        </div>
  </div>
  

</x-layout>
<x-layout>
  <x-slot:title>{{"List Job"}}</x-slot>
  <h3 class="text-xl">Job</h3>


{{-- SEARCH BAR Section --}}
  <x-job-list.search-bar :disabilities="$disabilities"></x-job-list.search-bar>

  {{-- JobCard --}}
  <div class="w-full flex justify-center">
        <div class="w-[90%] mb-10 flex flex-col justify-center">
            <div class="grid grid-cols-3 w-full gap-12 mt-10 ">
                {{-- @forelse ($companyCard as $card) --}}
                    <x-job-list.job-card :card="$card" ></x-job-list.job-card>
                {{-- @empty --}}
                    {{-- <p>There isn't a company available...</p> --}}
                {{-- @endforelse --}}
            </div>
            <div class="flex flex-col justify-center items-center mt-10">
                {{-- {{ $companyCard->links() }} --}}
            </div>
        </div>
  </div>
  

</x-layout>
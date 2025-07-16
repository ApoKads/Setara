@props(['detail', 'companies', 'jobCard'])

<x-layout>
  <x-slot:title>{{ $detail->name }} - Company Detail</x-slot>

    <div class="min-h-screen bg-[#F2F6FF] shadow-[inset_0_5px_5px_rgba(0,0,0,0.2)]">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          <div class="lg:col-span-2">
            <div class="mb-6">

              <div class="bg-gradient-to-r from-blue-500 to-blue-800 rounded-lg text-white h-36">
              </div>
              <div class="flex items-start gap-6">
                <div class="flex-1 px-6 pb-6">
                  <div class="h-18 overflow-visible">
                    <div
                      class="w-36 h-36 bg-[#F2F6FF] rounded-full flex justify-center items-center relative -top-18 left-0">
                      <!-- Company Logo -->
                      <div class="w-34 h-34 bg-blue-900 rounded-full flex items-center justify-center overflow-hidden">
                        @if($detail->path_logo)
              <img src="{{ asset('storage/' . $detail->path_logo) }}" alt="{{ $detail->name }}"
                class="w-full h-full object-cover">
            @else
              <img src="{{ asset('images/ListJobPage/company_placeholder.png') }}" alt="{{ $detail->name }}">
            @endif
                      </div>
                    </div>
                  </div>
                  <h1 class="text-3xl font-bold mb-2">{{ $detail->name }}</h1>
                  <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $detail->location ?? 'Not Available' }}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Company Description Section -->
            <div class="px-6 pb-6">
              <h2 class="text-xl font-bold text-gray-800 mb-4">Tentang Kami</h2>
              <div class="text-gray-600 leading-relaxed">
                {{ $detail->description ?? 'Not Available' }}
              </div>
            </div>

            <!-- Categories Section -->
            <div class="p-6">
              <h2 class="text-xl font-bold text-gray-800 mb-4">Kategori</h2>
              <div class="flex flex-wrap gap-2">
                @if($detail->categories && $detail->categories->count() > 0)
              @foreach($detail->categories as $category)
            <span
            class="bg-{{ $category->color }}-100 text-{{ $category->color }}-800 text-sm font-semibold px-2.5 py-1 rounded-lg">{{ $category->name }}</span>
          @endforeach
        @else
          <span class="text-gray-500">Not Available</span>
        @endif
              </div>
            </div>

            <!-- Address Section -->
            <div class="p-6">
              <h2 class="text-xl font-bold text-gray-800 mb-4">Alamat</h2>
              <div class="text-gray-600 leading-relaxed space-y-1">
                @if($detail->jalan || $detail->provinsi || $detail->kota || $detail->kode_pos)
              <div>{{ $detail->jalan ?? 'Not Available' }}</div>
              <div>
                @if($detail->provinsi || $detail->kota || $detail->kode_pos)
            {{ $detail->provinsi ?? '' }}{{ $detail->kota ? ', ' . $detail->kota : '' }}{{ $detail->kode_pos ? ', ' . $detail->kode_pos : '' }}
            @else
            Not Available
            @endif
              </div>
        @else
          <div class="text-gray-500">Not Available</div>
        @endif
              </div>
            </div>

            <!-- Contact Info Section -->
            <div class="p-6">
              <h2 class="text-xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
              <div class="space-y-3">
                <div class="flex items-center gap-3">
                  <div class="text-sm text-gray-500 min-w-[120px]">Nomor Telepon</div>
                  <div class="text-gray-800">
                    @if($detail->telepon_hrd)
            {{ $detail->telepon_hrd }}
          @else
            Not Available
          @endif
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="text-sm text-gray-500 min-w-[120px]">Website</div>
                  <div class="text-gray-800">
                    @if($detail->website)
            <a href="{{ $detail->website }}" target="_blank"
              class="text-blue-600 hover:text-blue-800 underline">{{ $detail->website }}</a>
          @else
            Not Available
          @endif
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="text-sm text-gray-500 min-w-[120px]">Email</div>
                  <div class="text-gray-800">
                    @if($detail->user && $detail->user->email)
            <a href="mailto:{{ $detail->user->email }}"
              class="text-blue-600 hover:text-blue-800 underline">{{ $detail->user->email }}</a>
          @elseif($detail->email)
            <a href="mailto:{{ $detail->email }}"
              class="text-blue-600 hover:text-blue-800 underline">{{ $detail->email }}</a>
          @else
            Not Available
          @endif
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sidebar (Right Side) - Company Recommendations -->
          <div class="lg:col-span-1">
            <div class="py-2 px-6 sticky top-8">
              <h2 class="text-2xl font-bold text-gray-800 mb-6">Perusahaan Lain</h2>

              <!-- Company Recommendation Items -->
              @foreach ($companies as $company)
            @if($company->id !== $detail->id)
          <div class="flex items-center gap-3 p-3 bg-white rounded-lg transition-colors mb-4">
          <!-- Company Logo -->
          <div
            class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
            @if($company->path_logo)
          <img src="{{ asset('storage/' . $company->path_logo) }}" alt="{{ $company->name }}"
          class="w-full h-full object-cover">
          @else
          <img src="{{ asset('images/ListJobPage/company_placeholder.png') }}" alt="{{ $company->name }}">
          @endif
          </div>

          <!-- Company Info -->
          <div class="flex-1 min-w-0">
            <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $company->name }}</h3>
            <p class="text-gray-500 text-[0.6rem] truncate">{{ $company->location ?? 'Not Available' }}</p>
          </div>

          <!-- View Details Button -->
          <a href="{{ route('companies.show', $company->slug) }}">
            <div
            class="text-blue-600 hover:text-white text-xs font-medium whitespace-nowrap bg-white hover:bg-blue-800 rounded-lg shadow-sm p-2 cursor-pointer">
            Lihat Detail
            </div>
          </a>
          </div>
        @endif
        @endforeach

            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Company Jobs Section -->
    <div class="p-6 bg-[#F8F9FD] shadow-[inset_0_5px_5px_rgba(0,0,0,0.2)]">
      <h2 class="px-16 pt-6 text-3xl font-bold text-gray-800 mb-4">Lowongan Kerja Kami</h2>

      <div class="w-full flex justify-center">
        <div class="w-[90%] mb-20 flex flex-col justify-center">
          <div class="grid grid-cols-3 w-full gap-12 mt-10 ">
            @forelse ($jobCard as $card)
        <x-job-list.job-card :card="$card"></x-job-list.job-card>
      @empty
        <p>There isn't a job available...</p>
      @endforelse
          </div>
          <div class="flex flex-col justify-center items-center mt-10">
            {{ $jobCard->links() }}
          </div>
        </div>
      </div>
    </div>

</x-layout>
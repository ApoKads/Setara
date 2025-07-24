<x-layout>
  <x-slot:title>{{ $detail->name }} - {{ $detail->company->name }}</x-slot>
  
  <div class="min-h-screen bg-[#F2F6FF] shadow-[inset_0_5px_5px_rgba(0,0,0,0.2)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      
      <!-- Flash Messages -->
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
          {{ session('success') }}
        </div>
      @endif

      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
          {{ session('error') }}
        </div>
      @endif

      @if (session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
          {{ session('info') }}
        </div>
      @endif
      
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2">
          <div class="mb-6">

            <div class="bg-gradient-to-r from-blue-500 to-blue-800 rounded-lg text-white h-36">
            </div>
            <div class="flex items-start gap-6">
              <div class="flex-1 px-6 pb-6">
                <div class="h-18 overflow-visible">
                  <div class="w-36 h-36 bg-[#F2F6FF] rounded-full flex justify-center items-center relative -top-18 left-0">
                    <div class="w-34 h-34 bg-blue-900 rounded-full flex items-center justify-center overflow-hidden">
                      @if($detail->company->path_logo)
                        <img src="{{ asset('storage/' . $detail->company->path_logo) }}" alt="{{ $detail->company->name }}" class="w-full h-full object-cover">
                      @else
                        <img src="{{ asset('images/ListJobPage/company_placeholder.png') }}" alt="{{ $detail->company->name }}">
                      @endif
                    </div>
                  </div>
                </div>
                <h1 class="text-3xl font-bold mb-2">{{ $detail->name }}</h1>
                <div class="flex items-center gap-2 mb-2">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                  </svg>
                  <span>{{ $detail->location->city }} · {{ $detail->company->name }}</span>
                </div>
                <div class="flex items-center gap-2">
                  <img src="{{ asset('images/ListJobPage/clock.svg') }}" class="w-5 h-5">
                  <span class="text-sm">Hingga 11 September 2021</span>
                </div>
                <div class="mt-4">
                  @if($hasApplied)
                    <button class="inline-block bg-gray-400 text-gray-600 px-6 py-2 rounded-lg font-medium cursor-not-allowed" disabled>
                      Sudah Melamar
                    </button>
                  @else
                    <a href="{{ route('job.apply', $detail->slug) }}" class="inline-block bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                      Lamar
                    </a>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow-sm p-6 mb-6 mx-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

              <div class="text-left">
                <div class="text-sm text-gray-500 mb-1">Gaji</div>
                <div class="text-xl font-semibold text-gray-800">
                  Rp{{ number_format($detail->wage, 0, ',', '.') }},00/Bln
                </div>
              </div>

              <div class="text-left">
                <div class="text-sm text-gray-500 mb-1">Tipe Pekerjaan</div>
                <div class="text-xl font-semibold text-gray-800">
                  {{ $detail->JobType->name }}
                </div>
              </div>

              <div class="text-left">
                <div class="text-sm text-gray-500 mb-1">Tempat Kerja</div>
                <div class="text-xl font-semibold text-gray-800">
                  {{ $detail->work_mode }}
                </div>
              </div>

              <div class="text-left">
                <div class="text-sm text-gray-500 mb-1">Tingkat Senioritas</div>
                <div class="text-xl font-semibold text-gray-800">
                  {{ $detail->seniority->name }}
                </div>
              </div>

              <div class="text-left">
                <div class="text-sm text-gray-500 mb-1">Jenis Disabilitas</div>
                <div class="text-xl font-semibold text-gray-800">
                  {{ $detail->disability->name }}
                </div>
              </div>
              
              <div class="text-left">
                <div class="text-sm text-gray-500 mb-1">Pendidikan Minimal</div>
                <div class="text-xl font-semibold text-gray-800">
                  {{ $detail->EducationLevel->name }}
                </div>
              </div>
              
            </div>
          </div>

          <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Mengenai Pekerjaan</h2>
            <div class="text-gray-600 leading-relaxed">
              {{ $detail->description }}
            </div>
          </div>

          <!-- Job Responsibilities Section -->
          <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Tanggung Jawab</h2>
            <div class="text-gray-600 leading-relaxed">
              {{ $detail->responsibilities }}
            </div>
          </div>

          <!-- Categories Section -->
          <!-- <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Kategori</h2>
            <div class="flex flex-wrap gap-2">
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Kontraktor</span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Temp</span>
              <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Pertambangan</span>
              <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">New</span>
              <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">Insert Here</span>
            </div>
          </div> -->
          
        </div>

        <!-- Sidebar (Right Side) - Job Recommendations -->
        <div class="lg:col-span-1">
          <div class="py-2 px-6 sticky top-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Lowongan Lain</h2>
            
            <!-- Job Recommendation Items -->
            @foreach ($jobCard as $card)
            <div class="flex items-center gap-3 p-3 bg-white rounded-lg transition-colors mb-4">
              <!-- Company Logo -->
              <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden">
                @if($card->company->path_logo)
                  <img src="{{ asset('storage/' . $card->company->path_logo) }}" alt="{{ $card->company->name }}" class="w-full h-full object-cover">
                @else
                  <img src="{{ asset('images/ListJobPage/company_placeholder.png') }}" alt="{{ $card->company->name }}">
                @endif
              </div>
              
              <!-- Job Info -->
              <div class="flex-1 min-w-0">
                <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $card->name }}</h3>
                <p class="text-gray-500 text-[0.6rem] truncate">{{ $card->location->city }} · {{ $card->company->name }}</p>
              </div>
              
              <!-- View Details Button -->
               <a href="{{ route('job.show', $card->slug) }}">
                 <div class="text-blue-600 hover:text-white text-xs font-medium whitespace-nowrap bg-white hover:bg-blue-800 rounded-lg shadow-sm p-2 cursor-pointer">
                   Lihat Detail
                 </div>
               </a>
            </div>
            @endforeach
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
</x-layout>

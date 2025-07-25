@props(['job'])

<x-layout>
  <x-slot:title>Lamar Pekerjaan - {{ $job->name }}</x-slot>
  
  <div class="min-h-screen bg-[#F8F9FD]">
    <!-- Banner Section -->
    <div class="relative bg-[#F2F6FF] overflow-hidden shadow-[inset_0_5px_5px_rgba(0,0,0,0.1)]">
      <div class="w-full">
        <div class="flex items-center justify-between">
          <!-- Left Side - Job Application Info -->
          <div class="flex-1 ml-8">
            <h1 class="text-5xl font-bold text-gray-950 mb-6">Job Application</h1>
            <div class="text-lg text-gray-600">
              <span>{{ $job->company->name }} / {{ $job->name }}</span>
            </div>
          </div>
          
          <!-- Right Side - Splash Graphic -->
          <div class="flex-1 flex justify-end">
            <img src="{{ asset('images/Splash.png') }}" alt="Splash graphic" class="max-w-lg w-full h-auto">
          </div>
        </div>
      </div>
    </div>

    <!-- Application Form Section -->
    <div class="w-full shadow-[inset_0_5px_5px_rgba(0,0,0,0.1)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <form action="{{ route('job.apply.submit', $job->id) }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Error and Success Messages -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Application Reason Section -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Apa alasan anda melamar pekerjaan ini?</h2>
                    
                    <div class="relative">
                        <textarea 
                        name="application_reason" 
                        id="application_reason" 
                        rows="10"
                        placeholder="Deskripsi Pekerjaan"
                        class="w-full px-6 py-6 border-2 @error('application_reason') border-red-500 @else border-blue-200 @enderror rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none resize-none text-lg placeholder-gray-400"
                        maxlength="1000"
                        required
                        >{{ old('application_reason') }}</textarea>
                        
                        <!-- Character Counter -->
                        <div class="absolute bottom-4 right-4 text-sm text-gray-500 bg-[#F8F9FD] px-1.5 py-1 rounded">
                            <span id="char-count">0</span>/1000
                        </div>
                    </div>
                    
                    @error('application_reason')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center pt-8">
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-12 py-4 rounded-xl transition-colors duration-200 text-lg min-w-[160px] cursor-pointer"
                    >
                        Lamar
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Character Counter Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const textarea = document.getElementById('application_reason');
      const charCount = document.getElementById('char-count');
      
      function updateCharCount() {
        const count = textarea.value.length;
        charCount.textContent = count;
        
        if (count > 1000) {
          charCount.classList.add('text-red-600');
          charCount.classList.remove('text-gray-500');
        } else {
          charCount.classList.add('text-gray-500');
          charCount.classList.remove('text-red-600');
        }
      }
      
      textarea.addEventListener('input', updateCharCount);
      updateCharCount(); // Initial count
    });
  </script>
</x-layout>

<x-layout>
    <x-slot:title>
        Homepage Setara
    </x-slot:title>

    <section class="bg-[#F2F6FF] shadow-md pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            {{-- Konten Kiri (Teks) --}}
            <div class="w-full md:w-2/5 text-center md:text-left mb-12 md:mb-0">
                <h1 class="text-4xl lg:text-6xl text-[#132442] mb-6 leading-tight">
                    Find Your
                    <span class="inline-flex items-center font-bold text-[#132442]">
                        DREAM JOB
                    </span>
                    Here
                </h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Break the Limitations, Find Your Perfect Job, and Unlock
                    Your Potential with Our Tailored Opportunities.
                </p>
                <div class="flex flex-col sm:flex-row mb-5 gap-4 justify-center md:justify-start">
                    <a href="#"
                        class="bg-[#132442] text-white font-bold py-3 px-8 rounded-full hover:bg-[#0B182E] transition duration-300 shadow-md">
                        See Jobs
                    </a>
                    <a href="#"
                        class="bg-white text-[#132442] font-semibold py-3 px-8 rounded-full border border-[#132442] hover:bg-gray-100 transition duration-300 shadow-md">
                        See Company
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center md:justify-end items-end">
                <img src="{{ asset('images/homepage_people.png') }}" alt="People on Homepage"
                    class="w-full max-w-2xl h-auto rounded-lg">
            </div>
        </div>
    </section>

</x-layout>
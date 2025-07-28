<x-layout>
    <x-slot:title>
        Homepage Setara
    </x-slot:title>

    <section class="bg-[#F2F6FF] shadow-md pt-16 font-poppins relative overflow-hidden">
        <img src="{{ asset('images/Homepage/cat1_home.png') }}" alt="Paint Splatter"
            class="absolute top-0 right-0 w-1/3 md:w-1/4 lg:w-1/5 h-auto z-0 transform translate-x-1/8 -translate-y-1/4 opacity-70">
        <img src="{{ asset('images/Homepage/cat1_home.png') }}" alt="Paint Splatter"
            class="absolute bottom-0 right-0 w-1/3 md:w-1/4 lg:w-1/5 h-auto z-0 transform translate-x-1/8 translate-y-1/4 rotate-90 opacity-70">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-end justify-between relative z-10">
            <div class="ml-10 w-full md:w-2/5 text-center md:text-left mb-12 md:mb-0">
                <h1 class="text-4xl lg:text-6xl text-[#132442] mb-6 leading-tight">
                    Temukan
                    <img src="{{ asset('images/Homepage/arrow_right_home.svg') }}" alt="Arrow Right"
                        class="inline-block mx-2 w-16 h-10 align-middle">
                    <span class="inline-flex items-center font-bold text-[#132442]">
                        PEKERJAAN IMPIAN
                    </span> Anda
                </h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Patahkan Keterbatasan, Cari Pekerjaan Impian Anda, dan Temukan Potensi Melalui Kesempatan Hebat.
                </p>
                <div class="flex flex-col sm:flex-row mb-5 gap-4 justify-center md:justify-start">
                    <a href="#"
                        class="bg-[#132442] text-white font-bold py-3 px-8 rounded-full hover:bg-[#0B182E] transition duration-300 shadow-md">
                        Lihat Lowongan
                    </a>
                    <a href="#"
                        class="bg-white text-[#132442] font-semibold py-3 px-8 rounded-full border border-[#132442] hover:bg-gray-100 transition duration-300 shadow-md">
                        Lihat Perusahaan
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center md:justify-end items-end">
                <img src="{{ asset('images/Homepage/homepage_people.png') }}" alt="People on Homepage"
                    class="w-full max-w-2xl h-auto rounded-lg">
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="mx-auto px-4 lg:px-8 text-center mt-20">
            <h2 class="text-4xl lg:text-5xl font-bold text-[#132442] my-16 mb-20">
                MENGAPA MENCARI PEKERJAAN DI SETARA?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-10 gap-y-12">
                <div class="flex flex-col items-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/Homepage/mengapa1.png') }}" alt="User Profiles Icon"
                            class="w-24 h-24 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#3551A4] mb-2">User Profiles & CV Creation</h3>
                    <p class="text-gray-[#132442] opacity-[60%] text-[15px] pt-3 leading-relaxed">
                        Pengguna dapat membuat dan mengelola profil yang berfungsi sebagai CV digital untuk melamar
                        pekerjaan dengan mudah.
                    </p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/Homepage/mengapa2.png') }}" alt="Difabel Friendly Icon"
                            class="w-24 h-24 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#249185] mb-2">Pekerjaan Ramah Difabel</h3>
                    <p class="text-gray-[#132442] opacity-[60%] text-[15px] pt-3 leading-relaxed">
                        Setara menyediakan daftar lowongan pekerjaan yang mendukung penyandang disabilitas dengan
                        informasi yang jelas mengenai posisi dan kriteria yang dapat dilamar.
                    </p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/Homepage/mengapa3.png') }}" alt="Profile Based Jobs Icon"
                            class="w-24 h-24 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#3551A4] mb-2">Pekerjaan Berdasarkan Profile</h3>
                    <p class="text-gray-[#132442] opacity-[60%] text-[15px] pt-3 leading-relaxed">
                        Setara menyesuaikan lowongan pekerjaan dengan keahlian dan minat pengguna, memastikan kesesuaian
                        pekerjaan dengan profil mereka.
                    </p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/Homepage/mengapa4.png') }}" alt="Application Status Icon"
                            class="w-24 h-24 object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-[#249185] mb-2">Status Laporan Lamaran</h3>
                    <p class="text-gray-[#132442] opacity-[60%] text-[15px] pt-3 leading-relaxed">
                        Pengguna dapat memantau status lamaran mereka melalui dashboard, untuk mengetahui apakah lamaran
                        diterima, sedang ditinjau, atau ditolak.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistika Setara -->
    <section class="py-12 bg-[#F2F6FF]">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center md:items-start gap-12">
            <div class="w-full md:w-2/3 text-center md:text-left">
                <h2 class="text-4xl lg:text-5xl font-bold text-[#132442] mb-6">
                    Statistika Setara
                </h2>
                <p class="text-gray-600 mb-12 leading-relaxed">
                    Mewujudkan kesempatan yang <span class="font-bold">setara</span> di dunia kerja bukan hanya tentang
                    memberi kesempatan,
                    tetapi juga menciptakan lingkungan yang mendukung penyandang disabilitas untuk berkompetisi
                    di level yang sama, tanpa diskriminasi. <span class="font-bold">Kami berkomitmen</span> untuk
                    menghilangkan hambatan dan
                    memastikan bahwa setiap individu memiliki akses yang setara untuk berkembang dan
                    berkontribusi.
                </p>

                <div class="bg-white rounded-lg shadow-lg p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset('images/Homepage/statistik1.png') }}" alt="Pengguna Terdaftar Icon"
                            class="w-12 h-12 mb-3 object-contain">
                        <p class="text-2xl font-bold text-[#3551A4]">3956</p>
                        <p class="text-sm text-[#3551A4]">Pengguna Disabilitas Terdaftar</p>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset('images/Homepage/statistik2.png') }}" alt="Lowongan Kerja Icon"
                            class="w-12 h-12 mb-3 object-contain">
                        <p class="text-2xl font-bold text-[#249185]">1456</p>
                        <p class="text-sm text-[#249185]">Lowongan Kerja Tersedia</p>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset('images/Homepage/statistik3.png') }}" alt="Perusahaan Kerja Sama Icon"
                            class="w-12 h-12 mb-3 object-contain">
                        <p class="text-2xl font-bold text-[#3551A4]">247</p>
                        <p class="text-sm text-[#3551A4]">Perusahaan yang Bekerja Sama</p>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset('images/Homepage/statistik4.png') }}" alt="Pengguna Direkrut Icon"
                            class="w-12 h-12 mb-3 object-contain">
                        <p class="text-2xl font-bold text-[#249185]">861</p>
                        <p class="text-sm text-[#249185]">Pengguna Disabilitas Telah Direkrut</p>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/3 flex justify-center md:justify-end mt-12 md:mt-18">
                <img src="{{ asset('images/Homepage/statistik_kanan.png') }}" alt="Ilustrasi Statistika"
                    class="w-full max-w-sm h-auto rounded-lg shadow-xl">
            </div>
        </div>
    </section>

    {{-- Bagian Peluang Kerja Terbaru --}}
    <section class="py-20 bg-white">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl lg:text-5xl font-bold text-[#132442] text-center mb-16">
                Peluang Kerja Terbaru
            </h2>

            @if($featuredJobs->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
                    @foreach($featuredJobs as $job)
                        <x-job-list.job-card :card="$job" />
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    <a href="{{ route('jobs') }}"
                        class="bg-[#132442] text-white font-bold py-3 px-8 rounded-full hover:bg-[#0B182E] transition duration-300 shadow-md">
                        Lihat Semua Lowongan
                    </a>
                </div>
            @else
                <p class="text-center text-gray-600 text-lg">Belum ada lowongan pekerjaan terbaru saat ini.</p>
            @endif
        </div>
    </section>

</x-layout>
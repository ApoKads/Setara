<x-layout>
    <x-slot:title>
        Edit Profile
    </x-slot:title>

    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <div class="mb-6">
            <a href="{{ route('profile.show') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Profil
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p class="font-bold">Sukses</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                <p class="font-bold">Terjadi Kesalahan</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl p-6 md:p-8">
                <h2 class="text-2xl font-bold text-gray-800 border-b pb-4">Edit Profil Utama</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->profile->name) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div>
                                <label for="job_status" class="block text-sm font-medium text-gray-700">Status
                                    Pekerjaan</label>
                                <input type="text" id="job_status" name="job_status"
                                    value="{{ old('job_status', $user->profile->job_status) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Usia</label>
                                <input type="number" id="age" name="age" value="{{ old('age', $user->profile->age) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label for="quote" class="block text-sm font-medium text-gray-700">Kutipan /
                                    Motto</label>
                                <input type="text" id="quote" name="quote"
                                    value="{{ old('quote', $user->profile->quote) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                            </div>
                            <div>
                                <label for="profile_image" class="block text-sm font-medium text-gray-700">Ganti Foto
                                    Profil</label>
                                <input type="file" name="profile_image" id="profile_image"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="about" class="block text-sm font-medium text-gray-700">Tentang Saya (Deskripsi
                            Singkat)</label>
                        <textarea id="about" name="about" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">{{ old('about', $user->profile->about) }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                            Mendalam</label>
                        <textarea id="description" name="description" rows="5"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $user->profile->description) }}</textarea>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md cursor-pointer transition duration-300">Update
                            Profil</button>
                    </div>
                </form>
            </div>
            @include('UserSide.edit-partials.career-history-card')
            @include('UserSide.edit-partials.skills-card')
        </div>
    </div>
</x-layout>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/4 flex justify-center mb-4 md:mb-0">
                    <img src="{{ $user->profile->profile_image ? asset('storage/profile_images/' . $user->profile->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->profile->name) . '&color=7F9CF5&background=EBF4FF' }}"
                        alt="Profile Image" class="w-36 h-36 rounded-full object-cover shadow-lg border-4 border-white">
                </div>

                <div class="w-full md:w-3/4 text-center md:text-left md:pl-8">
                    <h2 class="text-3xl font-semibold text-gray-800">
                        Halo, saya <span class="text-blue-600">{{ $user->profile->name }}</span>
                    </h2>
                    <p class="text-xl text-gray-600 mt-2">
                        {{ $user->profile->job_status }}
                    </p>
                    @if($user->profile->quote)
                        <p class="text-lg text-gray-500 mt-4 italic">"{{ $user->profile->quote }}"</p>
                    @endif
                </div>
            </div>

            <hr class="my-6">

            <div>
                <h3 class="text-xl font-semibold text-gray-800">Tentang Saya</h3>
                <p class="mt-2 text-gray-700">{{ $user->profile->about ?? 'Belum ada deskripsi.' }}</p>
                <p class="mt-2 text-gray-600"><strong>Usia:</strong> {{ $user->profile->age ?? 'N/A' }} tahun</p>
            </div>
        </div>

        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-gray-800 border-b pb-4">Edit Profile Anda</h3>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->profile->name) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="job_status" class="block text-sm font-medium text-gray-700">Status
                                Pekerjaan</label>
                            <input type="text" id="job_status" name="job_status"
                                value="{{ old('job_status', $user->profile->job_status) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('job_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="age" class="block text-sm font-medium text-gray-700">Usia</label>
                            <input type="number" id="age" name="age" value="{{ old('age', $user->profile->age) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <div class="mb-4">
                            <label for="quote" class="block text-sm font-medium text-gray-700">Kutipan / Motto</label>
                            <input type="text" id="quote" name="quote" value="{{ old('quote', $user->profile->quote) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                            @error('quote') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="profile_image" class="block text-sm font-medium text-gray-700">Ganti Foto Profil
                                (Opsional)</label>
                            <input type="file" name="profile_image" id="profile_image"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('profile_image') <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="about" class="block text-sm font-medium text-gray-700">Tentang Saya</label>
                    <textarea id="about" name="about" rows="4"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">{{ old('about', $user->profile->about) }}</textarea>
                    @error('about') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>


        @if($user->profile->careerHistories->count() > 0)
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800">Riwayat Karir</h3>
                <ul class="mt-4 space-y-4 divide-y divide-gray-200">
                    @foreach($user->profile->careerHistories as $history)
                        <li class="pt-4 first:pt-0">
                            <h4 class="font-medium text-lg text-gray-800">{{ $history->job_title }} di {{ $history->company }}
                            </h4>
                            <p class="text-sm text-gray-600">({{ \Carbon\Carbon::parse($history->start_date)->format('F Y') }} -
                                {{ $history->end_date ? \Carbon\Carbon::parse($history->end_date)->format('F Y') : 'Sekarang' }})
                            </p>
                            <p class="text-gray-700 mt-2">{{ $history->job_description }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</body>

</html>
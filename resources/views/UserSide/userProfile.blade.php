@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-12">
        <!-- Profile Banner -->
        <div class="flex justify-between items-center bg-gray-100 p-6 rounded-lg shadow-md">
            <!-- Left: User Info -->
            <div class="w-2/3">
                <h2 class="text-3xl font-semibold text-gray-800">Halo Pelamar!</h2>
                <p class="text-xl text-gray-600 mt-2">
                    Saya <span class="font-semibold">{{ $user->profile->name }}</span>,
                    {{ $user->profile->job_status }}
                </p>
                <p class="text-lg text-gray-500 mt-4 italic">"{{ $user->profile->quote }}"</p>
            </div>

            <!-- Right: Profile Image -->
            <div class="w-1/3 flex justify-center">
                <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="Profile Image"
                    class="w-36 h-36 rounded-full object-cover shadow-lg border-4 border-white">
            </div>
        </div>

        <!-- Profile Information -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-gray-800">Profile Information</h3>
            <p class="mt-4 text-gray-600"><strong>About:</strong> {{ $user->profile->about }}</p>
            <p class="mt-2 text-gray-600"><strong>Age:</strong> {{ $user->profile->age }} years old</p>
        </div>

        <!-- Career History (if any) -->
        @if($user->profile->careerHistories->count() > 0)
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800">Career History</h3>
                <ul class="mt-4 space-y-4">
                    @foreach($user->profile->careerHistories as $history)
                        <li>
                            <h4 class="font-medium text-lg text-gray-800">{{ $history->job_title }} at {{ $history->company }}</h4>
                            <p class="text-gray-600">({{ $history->start_date }} - {{ $history->end_date }})</p>
                            <p class="text-gray-500">{{ $history->job_description }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="profile_image">Upload Profile Image</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*">
        </div>
        <button type="submit">Update Profile</button>
    </form>

    <img src="{{ asset('storage/profile_images/' . $user->profile->profile_image) }}" alt="Profile Image"
        class="w-36 h-36 rounded-full">



@endsection
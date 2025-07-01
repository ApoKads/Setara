<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  @vite('resources/css/app.css')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://kit.fontawesome.com/88be1c9f1b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <!-- @livewireStyles -->
</head>

<body class="h-full">

  <div class="min-h-full">
    <!-- Navbar -->
    @include('components.navbar')
    {{-- <x-header>{{$title}}</x-header> --}}

    <main>
      <div class="w-full">
        {{$slot}}
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  @livewireScripts
</body>

</html>
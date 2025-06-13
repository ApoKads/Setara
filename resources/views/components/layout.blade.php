<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/88be1c9f1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ 'C:\xampp\htdocs\Setara\resources\css\app.css' }}">
    @livewireStyles
</head>
<body class="h-full">

<div class="min-h-full">
  <!-- Navbar -->
  @include('components.navbar')
  
  {{-- <x-navbar></x-navbar>  <!-- This truly disables the component --> --}}
  
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
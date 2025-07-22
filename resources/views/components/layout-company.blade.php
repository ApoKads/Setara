<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @livewireStyles
</head>
<body class="h-full">

<div class="min-h-full">
  {{-- <x-navbar></x-navbar>  <!-- This truly disables the component --> --}}
  
  {{-- <x-header>{{$title}}</x-header> --}}

  
  <main>
    @include('components/navbar-company')

    {{-- Content --}}
    <div class="relative w-full min-h-screen bg-gradient-to-b from-white to-[#DCE4F1]">
      {{$slot}}
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>    
@livewireScripts
</body>
</html>
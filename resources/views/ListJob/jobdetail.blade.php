<x-layout>
  <x-slot:title>{{"JobDetail"}}</x-slot>
  <h3 class="text-xl">Job Detail</h3>
  <h1>Job Provider: {{ $detail->company->name }}</h1>
  <h1>Job Name: {{ $detail->name }}</h1>
  <h1>Wage: {{ $detail->wage }}</h1>

</x-layout>
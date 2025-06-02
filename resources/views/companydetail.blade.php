@props(['detail'])

<x-layout>
  <x-slot:title>{{"List Company"}}</x-slot>
  <h3 class="text-xl">Company Detail</h3>

  <h3>Name : {{ $detail['name'] }}</h3>

</x-layout>
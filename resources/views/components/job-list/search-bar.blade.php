@props(['disabilities','JobType'])

<div class="bg-[#169CF0] w-full h-52 flex justify-center items-center relative">
    <div class="flex h-full w-full absolute overflow-hidden justify-between">
        <img src="{{ asset('images/Bubble blue.png') }}" alt="Bubble Blue" class="h-[450px] -mt-[154px]">
        <img src="{{ asset('images/Bubble blue.png') }}" alt="Bubble Blue" class="h-[450px] -mt-[154px]">
    </div>


    {{-- SEARCH BAR --}}
    <form action="" method="GET" class="w-[80%] h-full flex flex-col justify-center items-center gap-2">
        <div class="bg-white w-full px-8 py-5  rounded-2xl shadow-inner drop-shadow-xl border-gray-50 z-10">
            <div  class="flex items-center space-x-4 h-full">
                <div class="w-[50%] border-black border-[1px] rounded-lg">
                    <input type="text"
                        name="search"
                        placeholder="Cari Pekerjaan Impianmu ..."
                        class="w-full px-4 py-3 border text-base border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ request('search') }}">
                </div>


                {{--Filter Disabilitas--}}
                <div class="relative w-[20%] border-black border-[1px] rounded-lg">
                    <select name="disability"
                            class="block appearance-none w-full text-base bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:cursor-pointer">
                        <option value="">Tipe Disabilitas</option>
                        @foreach ( $disabilities as $dis)
                            <option value="{{ $dis->id }}" {{ request('disability') == $dis->id ? 'selected' : '' }}>
                                {{ $dis->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.757 7.586 5.343 9z"/>
                        </svg>
                    </div>
                </div>

                {{-- Jenis Pekerjaan --}}
                {{-- <div class="relative w-[30%] border-black border-[1px] rounded-lg">
                    <select name="tag"
                            class="block appearance-none w-full text-base bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:cursor-pointer">
                        <option value="">Kategori Pekerjaan</option>
                        @foreach ( $JobType as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.757 7.586 5.343 9z"/>
                        </svg>
                    </div>
                </div> --}}
                {{-- @livewire('job-type-search') --}}
                <livewire:job-type-dropdown />

                <div>
                    <button type="submit"
                            class="flex items-center justify-center h-full px-2 py-1.5 hover:cursor-pointer bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full flex justify-start items-center text-white font-bold text-xl z-10">
            Advanced Filters:
        </div>

    </form action="" method="GET">
  </div>
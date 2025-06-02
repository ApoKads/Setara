@props(['card'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-[27rem]">
                {{-- Gambar logo BCA --}}
                <div class="h-48 flex items-center justify-center bg-red object-cover">
                    @if ($card->path_banner)
                        <img src="{{ asset('storage/' . $card->path_banner) }}" alt="BCA Logo" class="h-full w-full object-cover">
                    @else
                        <p>empty</p>
                    @endif
                </div>

                <div class="px-5 pb-5 pt-4">
                    {{-- Kategori / Tags --}}
                    <div class="flex flex-wrap gap-2 mb-2">
                        @foreach ($card->categories as $category)
                            <span class="bg-{{ $category->color }}-100 text-{{ $category->color }}-800 text-xs font-semibold px-2.5 py-1 rounded-lg">{{ $category['name'] }}</span>
                        @endforeach
                    </div>



                    {{-- Detail Perusahaan --}}
                    <div class="flex items-center space-x-1 mb-3">
                        <img src="{{ asset('storage/' . $card->path_logo) }}" alt="Company Logo" class="w-16 h-16 rounded-full border-2 border-gray-200 object-contain">
                        <div>
                            <h3 class="text-lg font-pop font-medium text-gray-900">{{ $card['name'] }}</h3>
                            <p class="text-sm text-gray-500 flex items-center">
                                <svg class="w-4 h-4 mr-0.5 text-gray-400 font-pop" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                {{ $card['location'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Deskripsi Perusahaan --}}
                    <p class="text-gray-700 text-sm leading-relaxed line-clamp-4">
                                {{ $card['description'] }} 
                    </p>

                </div>
</div>
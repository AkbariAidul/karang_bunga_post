@props([
    'title',
    'categorySlug',
    'mainArticle',
    'articles',
])

{{-- 
  Komponen Grid "Lingkungan"
  - Font size disesuaikan agar lebih proporsional
--}}
<section id="latest-{{ Str::slug($categorySlug) }}" class="max-w-[1130px] mx-auto flex flex-col gap-6 mt-[70px] px-4">
    
    <div class="flex justify-between items-center">
        {{-- 
          FONT-SIZE DIPERBAIKI: 
          text-2xl md:text-[26px] -> text-xl md:text-2xl
        --}}
        <h2 class="font-bold text-xl md:text-2xl uppercase text-gray-900">
            {!! $title !!}
        </h2>
        
        <a href="{{ route('front.category', $categorySlug) }}"
            class="flex gap-1 items-center font-semibold transition-all duration-300 text-[#407a1b] hover:text-[#a0d97b] shrink-0">
            <span>Artikel Lainnya</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col gap-6">
        
        @if ($mainArticle)
            <a href="{{ route('front.details', $mainArticle->slug) }}" class="grid grid-cols-1 md:grid-cols-2 gap-6 group">
                
                {{-- Gambar Artikel Utama --}}
                <div class="w-full h-[300px] rounded-2xl overflow-hidden bg-gray-100">
                    <img src="{{ Storage::url($mainArticle->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="thumbnail">
                </div>
                
                {{-- Info Artikel Utama --}}
                <div class="flex flex-col justify-center gap-2">
                    {{-- 
                      FONT-SIZE DIPERBAIKI: 
                      text-2xl md:text-3xl -> text-xl md:text-2xl
                    --}}
                    <h3 class="font-bold text-xl md:text-2xl leading-tight text-gray-900 group-hover:text-[#407a1b] transition-colors duration-300">
                        {{ Str::limit($mainArticle->name, 60) }}
                    </h3>
                    
                    <p class="text-gray-500 text-base">
                        {{ Str::limit(strip_tags($mainArticle->description ?? $mainArticle->summary ?? ''), 120) }}
                    </p>
                    <p class="text-sm text-gray-400 mt-2">{{ $mainArticle->created_at->format('M d, Y') }}</p>
                </div>
            </a>
        @endif

        <div class="category-grid-carousel pt-6 border-t border-gray-200">
            @forelse ($articles as $article)
                <a href="{{ route('front.details', $article->slug) }}" class="card-news group w-[90%] md:w-1/3 px-2">
                    <div class="flex flex-col gap-4">
                        <div class="thumbnail-container w-full h-[200px] rounded-2xl flex shrink-0 overflow-hidden relative bg-gray-100">
                            <img src="{{ Storage::url($article->thumbnail) }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300" alt="thumbnail" />
                        </div>
                        <div class="card-info flex flex-col gap-1">
                            {{-- 
                              FONT-SIZE DIPERBAIKI: 
                              text-lg -> text-base md:text-lg
                            --}}
                            <h3 class="font-bold text-base md:text-lg leading-snug text-gray-900 group-hover:text-[#407a1b] transition-colors duration-300">
                                {{ Str::limit($article->name, 50) }}
                            </h3>
                            <p class="text-sm text-gray-400">
                                {{ $article->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 w-full text-center">Belum ada artikel di kategori ini...</p>
            @endforelse
        </div>
    </div>
</section>
@props([
    'title',
    'categorySlug',
    'featuredArticle',
    'articles',
])

{{-- Card dikembalikan ke bg-white --}}
<section id="latest-{{ Str::slug($categorySlug) }}"
    class="flex flex-col gap-[30px] bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
    <div class="flex items-center justify-between">
        <h2 class="font-bold text-2xl md:text-[26px] leading-tight md:leading-[39px] text-gray-900">
            {!! $title !!}
        </h2>
        {{-- Tombol diubah ke border light dan hover:ring Hijau Utama --}}
        <a href="{{ route('front.category', $categorySlug) }}"
            class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] text-gray-700 hover:ring-2 hover:ring-[#407a1b] shrink-0">Explore
            All</a>
    </div>
    <div class="flex flex-col lg:flex-row items-stretch justify-between h-fit gap-6 lg:gap-0">

        @if ($featuredArticle)
            <div class="featured-news-card relative w-full h-[424px] flex flex-1 rounded-[20px] overflow-hidden">
                <img src="{{ Storage::url($featuredArticle->thumbnail) }}"
                    class="absolute object-cover w-full h-full thumbnail" alt="icon" />
                <div class="w-full h-full bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.9)] absolute z-10">
                </div>
                <div class="card-detail w-full flex items-end p-[30px] relative z-20">
                    <div class="flex flex-col gap-[10px]">
                        <p class="text-white">Featured</p>
                        <a href="{{ route('front.details', $featuredArticle->slug) }}"
                            class="font-bold text-2xl md:text-[30px] leading-tight md:leading-[36px] text-white hover:underline transition-all duration-300 two-lines">
                            {{ $featuredArticle->name }}
                        </a>
                        <p class="text-white">
                            {{ $featuredArticle->created_at->format('M d, Y') }}
                        </d>
                    </div>
                </div>
            </div>
        @endif

        <div class="h-[424px] w-full lg:w-fit lg:px-5 overflow-y-scroll overflow-x-hidden relative custom-scrollbar">
            <div class="w-full lg:w-[455px] flex flex-col gap-5 shrink-0">
                @forelse ($articles as $article)
                    <a href="{{ route('front.details', $article->slug) }}" class="card py-[2px]">
                        {{-- Card list dikembalikan ke border light dan hover:ring Hijau Utama --}}
                        <div
                            class="rounded-[20px] border border-[#EEF0F7] p-[14px] flex items-center gap-4 hover:ring-2 hover:ring-[#407a1b] transition-all duration-300">
                            <div class="w-[130px] h-[100px] flex shrink-0 rounded-[20px] overflow-hidden">
                                <img src="{{ Storage::url($article->thumbnail) }}" class="object-cover w-full h-full"
                                    alt="thumbnail" />
                            </div>
                            <div class="flex flex-col justify-center-center gap-[6px] w-full">
                                <h3 class="font-bold text-lg leading-[27px] truncate text-gray-900">
                                    {{ Str::limit($article->name, 50) }}
                                </h3>
                                <p class="text-sm leading-[21px] text-gray-400">
                                    {{ $article->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">Belum ada data terbaru di kategori ini...</p>
                @endforelse
            </div>
            {{-- Gradient dikembalikan ke putih --}}
            <div
                class="sticky z-10 bottom-0 w-full h-[100px] bg-gradient-to-b from-transparent to-white">
            </div>
        </div>
    </div>
</section>
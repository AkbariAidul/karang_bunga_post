@extends('front.master')

@section('content')

    <div class="font-[Poppins] pb-[72px] bg-white-50">
        <x-navbar />

	<div x-data="{ showModal: false }">
	<nav id="Category"
     class="max-w-[1130px] mx-auto flex justify-center items-center gap-4 flex-nowrap mt-4 mb-0 overflow-visible">



        @foreach ($categories->take(5) as $category)
        <a href="{{ route('front.category', $category->slug) }}" 
           class="rounded-full px-[18px] py-[10px] flex items-center gap-[8px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#68a63e] shrink">
            <div class="w-5 h-5 shrink-0">
                <img src="{{ Storage::url($category->icon) }}" alt="icon" class="w-full h-full object-contain" />
            </div>
            <span class="truncate">{{ $category->name }}</span>
        </a>
        @endforeach

        @if ($categories->count() > 5)
        <button @click="showModal = true" 
                class="rounded-full px-[18px] py-[10px] flex items-center gap-[8px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#68a63e] shrink">
            <div class="w-5 h-5 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6a2 2 0 012-2h2a2 2 0 
                          012 2v2a2 2 0 01-2 2H6a2 2 0 
                          01-2-2V6zM14 6a2 2 0 
                          012-2h2a2 2 0 012 2v2a2 2 0 
                          01-2 2h-2a2 2 0 
                          01-2-2V6zM4 16a2 2 0 
                          012-2h2a2 2 0 012 2v2a2 2 0 
                          01-2 2H6a2 2 0 
                          01-2-2v-2zM14 16a2 2 0 
                          012-2h2a2 2 0 012 2v2a2 2 0 
                          01-2 2h-2a2 2 0 
                          01-2-2v-2z"></path>
                </svg>
            </div>
            <span>Semua Kategori</span>
        </button>
        @endif

    </nav>

    <!-- MODAL KATEGORI -->
    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.outside="showModal = false"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
    style="display: none;">
    <div x-show="showModal" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900">Pilih Kategori</h3>
            <button @click="showModal = false"
                class="p-1 rounded-full text-gray-400 hover:text-gray-800 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-[60vh] overflow-y-auto p-1">
            @foreach ($categories as $category)
                
                <a href="{{ route('front.category', $category->slug) }}"
                    class="rounded-xl p-4 flex items-center gap-3 font-semibold text-gray-700 transition-all duration-300 border border-transparent hover:border-[#407a1b] hover:bg-gray-50">
                    <div class="w-8 h-8 shrink-0">
                        <img src="{{ Storage::url($category->icon) }}" alt="icon"
                            class="w-full h-full object-contain" />
                    </div>
                    <span>{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

</div>

        <section id="Hero-Grid" class="max-w-[1130px] mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8 px-4">
            
            <div class="lg:col-span-2">
                <div class="w-full main-carousel relative rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    @forelse ($featured_articles as $article)
                        <div class="featured-news-card relative w-full h-[550px] flex shrink-0 overflow-hidden">
                            <img src="{{ Storage::url($article->thumbnail) }}"
                                class="absolute object-cover w-full h-full thumbnail" alt="icon" />
                            <div
                                class="w-full h-full bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.9)] absolute z-10">
                            </div>
                            <div
                                class="card-detail w-full mx-auto flex items-end justify-between pb-10 relative z-20 px-4">
                                <div class="flex flex-col gap-[10px]">
                                    <p class="text-white">Featured</p>
                                    <a href="{{ route('front.details', $article->slug) }}"
                                        class="font-bold text-3xl md:text-4xl leading-tight md:leading-[45px] text-white two-lines hover:underline transition-all duration-300">
                                        {{ $article->name }}
                                    </a>
                                    <p class="text-white">
                                        {{ $article->created_at->format('M d, Y') }} • {{ $article->category->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Card dikembalikan ke bg-white --}}
                        <div class="w-full h-[550px] flex items-center justify-center bg-white">
                            <p class="text-gray-500 text-xl">Belum ada data terbaru...</p>
                        </div>
                    @endforelse

                    @if ($featured_articles->count() > 0)
                        <div
                            class="prevNextButtons absolute z-30 w-full left-1/2 -translate-x-1/2 bottom-10 px-4 flex justify-end pointer-events-none">
                            <div class="flex items-center gap-4 mb-[10px] pointer-events-auto">
                                <button
                                    class="button--previous appearance-none w-[38px] h-[38px] flex items-center justify-center rounded-full shrink-0 ring-1 ring-white hover:ring-2 hover:ring-[#a0d97b] transition-all duration-300">
                                    <img src="{{ asset('assets/images/icons/arrow.svg') }}" alt="arrow" />
                                </button>
                                <button
                                    class="button--next appearance-none w-[38px] h-[38px] flex items-center justify-center rounded-full shrink-0 ring-1 ring-white hover:ring-2 hover:ring-[#a0d97b] transition-all duration-300 rotate-180">
                                    <img src="{{ asset('assets/images/icons/arrow.svg') }}" alt="arrow" />
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="lg:col-span-1">
                {{-- Card dikembalikan ke bg-white --}}
                <div class="bg-white p-6 rounded-2xl border border-gray-200 flex flex-col gap-4 h-full">
                    <h3 class="font-bold text-xl text-gray-900">Trending Now</h3>
                    <div class="flex flex-col gap-5">
                        @forelse ($articles->take(10) as $trendingArticle)
                            <a href="{{ route('front.details', $trendingArticle->slug) }}" class="flex items-center gap-4 group">
                                <div class="w-[100px] h-[80px] rounded-lg overflow-hidden shrink-0">
                                    <img src="{{ Storage::url($trendingArticle->thumbnail) }}" class="w-full h-full object-cover" alt="trending">
                                </div>
                                <div class="flex flex-col gap-1">
                                    {{-- Kategori diubah jadi Hijau Ikon --}}
                                    <p class="text-xs text-[#68a63e] font-bold uppercase">{{ $trendingArticle->category->name }}</p>
                                    {{-- Teks judul dan hover diubah --}}
                                    <h4 class="font-semibold text-sm leading-snug two-lines text-gray-800 group-hover:text-[#407a1b] transition-colors">
                                        {{ $trendingArticle->name }}
                                    </h4>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">No trending articles.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </section>


        <div class="max-w-[1130px] mx-auto flex flex-col lg:flex-row gap-[50px] mt-[70px] px-4">

            <main class="w-full lg:w-[calc(70%-25px)] flex flex-col gap-[70px]">

                <section id="Up-to-date" class="flex flex-col gap-[30px]">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-2xl md:text-[26px] leading-tight md:leading-[39px] text-gray-900">
                            Latest Hot News
                        </h2>
                        
                        <p
                            class="badge-orange rounded-full p-[8px_18px] bg-[#68a63e] font-bold text-sm leading-[21px] text-[#EEF0F7] w-fit shrink-0">
                            UP TO DATE</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-[30px]">
                        @forelse ($articles as $article)
                            <a href="{{ route('front.details', $article->slug) }}" class="card-news">
                                {{-- Card dikembalikan ke bg-white. Hover ring diubah ke Hijau Utama --}}
                                <div
                                    class="rounded-[20px] border border-gray-200 p-5 flex flex-col gap-4 hover:ring-2 hover:ring-[#407a1b] transition-all duration-300 bg-white h-full shadow-sm">
                                    <div
                                        class="thumbnail-container w-full h-[200px] rounded-[12px] flex shrink-0 overflow-hidden relative">
                                        <p
                                            class="badge-white absolute top-4 left-4 rounded-full p-[8px_18px] bg-white text-gray-800 font-bold text-xs leading-[18px] uppercase z-10">
                                            {{ $article->category->name }}</p>
                                        <img src="{{ Storage::url($article->thumbnail) }}"
                                            class="object-cover w-full h-full" alt="thumbnail" />
                                    </div>
                                    <div class="card-info flex flex-col gap-[6px]">
                                        <h3 class="font-bold text-lg leading-[27px] two-lines text-gray-900">
                                            {{ $article->name }}
                                        </h3>
                                        <p class="text-sm leading-[21px] text-gray-400">
                                            {{ $article->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="col-span-2 text-gray-500">Belum ada data terbaru...</p>
                        @endforelse
                    </div>
                </section>

                <section id="Advertisement" class="flex justify-center">
                    <div class="flex flex-col gap-3 shrink-0 w-full">
                        <a href="{{ $bannerads->link }}">
                            <div
                                class="w-full max-w-[900px] mx-auto h-[120px] flex shrink-0 border border-gray-200 bg-white rounded-2xl overflow-hidden">
                                <img src="{{ Storage::url($bannerads->thumbnail) }}"
                                    class="object-cover w-full h-full" alt="ads" />
                            </div>
                        </a>
                        <p class="font-medium text-sm leading-[21px] text-gray-400 flex gap-1 justify-center">
                            Our Advertisement
                            <a href="#" class="w-[18px] h-[18px]">
                                <img src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" />
                            </a>
                        </p>
                    </div>
                </section>

                <x-category-grid 
                    title="Latest For You <br /> in Pemerintahan"
                    categorySlug="pemerintahan" 
                    :featuredArticle="$pemerintahan_featured_articles"
                    :mainArticle="$pemerintahan_featured_articles"
                    :articles="$pemerintahan_articles" />

                 <x-category-grid 
                    title="Latest For You <br /> in Pembangunan"
                    categorySlug="pembangunan" 
                    :featuredArticle="$pembangunan_featured_articles"
                    :mainArticle="$pembangunan_featured_articles"
                    :articles="$pembangunan_articles" />

                <x-category-grid
                    title="Latest For You <br /> in Pertanian"
                    categorySlug="pertanian" 
                    :featuredArticle="$pertanian_featured_articles"
                    :mainArticle="$pertanian_featured_articles"
                    :articles="$pertanian_articles" />
            </main>

            <aside class="w-full lg:w-[calc(30%-25px)] flex flex-col gap-[40px]">

                <section id="All-Categories" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-xl text-gray-900 mb-4">
                        All Categories
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($categories as $category)
                            {{-- Tag diubah ke bg-gray-100 dan hover: Hijau Ikon --}}
                            <a href="{{ route('front.category', $category->slug) }}"
                                class="rounded-full px-4 py-2 flex items-center gap-2 text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-[#68a63e] hover:text-white">
                                <div class="w-4 h-4 shrink-0">
                                    <img src="{{ Storage::url($category->icon) }}" alt="icon"
                                        class="w-full h-full object-contain" />
                                </div>
                                <span>{{ $category->name }}</span>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada kategori...</p>
                        @endforelse
                    </div>
                </section>

                <section id="Best-authors" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <div class="flex flex-col text-left gap-2 items-start mb-4">
                        <p
                            class="badge-orange rounded-full p-[8px_18px] bg-[#68a63e] font-bold text-sm leading-[21px] text-[#EEF0F7] w-fit">
                            BEST AUTHORS</p>
                        <h3 class="font-bold text-xl text-gray-900">
                            Top Writers
                        </h3>
                    </div>
                    <div class="flex flex-col divide-y divide-gray-100">
                        @forelse ($authors->take(5) as $author)
                            <a href="{{ route('front.author', $author->slug) }}" class="card-authors-list py-4 flex items-center gap-4 group">
                                <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                                    <img src="{{ Storage::url($author->avatar) }}"
                                        class="object-cover w-full h-full" alt="avatar" />
                                </div>
                                <div class="flex flex-col gap-0">
                                    <p class="font-semibold text-gray-900 group-hover:text-[#407a1b] transition-colors">
                                        {{ $author->name }}
                                    </p>
                                    <p class="text-sm leading-[21px] text-gray-400">
                                        {{ $author->news_count }} News
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500">Belum ada data author...</p>
                        @endforelse
                    </div>
                </section>

                         <section id="Weather-Widget" class="sticky top-[100px]">
                    @if ($weatherData)
                        <div class="w-full bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                            <div class="text-center">
                                <p class="font-semibold text-lg text-gray-800">Cuaca di {{ $weatherData['city'] }}</p>
                                <img src="https://openweathermap.org/img/wn/{{ $weatherData['today']['weather'][0]['icon'] }}@2x.png" 
                                     alt="{{ $weatherData['today']['weather'][0]['description'] }}" 
                                     class="w-24 h-24 mx-auto -mt-2 -mb-2">
                                <p class="font-bold text-5xl text-gray-900">{{ round($weatherData['today']['main']['temp']) }}°C</p>
                                <p class="text-base text-gray-500 capitalize -mt-1">
                                    {{ $weatherData['today']['weather'][0]['description'] }}
                                </p>
                            </div>
                            <div class="border-t border-gray-100 my-4"></div>
                            <div class="flex flex-col gap-3">
                                <p class="font-bold text-gray-800">Prakiraan 4 Hari</p>
                                <div class="flex flex-col gap-2">
                                    @foreach ($weatherData['forecast'] as $day)
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-gray-600 font-semibold w-20">
                                                {{ \Carbon\Carbon::parse($day['dt_txt'])->translatedFormat('l') }}
                                            </span>
                                            <div class="flex items-center gap-1">
                                                <img src="https://openweathermap.org/img/wn/{{ $day['weather'][0]['icon'] }}.png" 
                                                     alt="{{ $day['weather'][0]['description'] }}" 
                                                     class="w-6 h-6">
                                                <span class="text-gray-500 capitalize w-20 hidden md:block">{{ $day['weather'][0]['description'] }}</span>
                                            </div>
                                            <span class="font-bold text-gray-800 text-right w-16">{{ round($day['main']['temp_max']) }}° / {{ round($day['main']['temp_min']) }}°</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-[600px] bg-gray-100 rounded-2xl border border-gray-200 flex items-center justify-center shadow-sm">
                            <p class="text-gray-400 p-4 text-center">Gagal memuat data cuaca.<br>Coba lagi nanti.</p>
                        </div>
                    @endif
                </section>

            </aside>
        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
@endpush

@push('after-scripts')
    <script src="{{ asset('customjs/two-lines-text.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('customjs/carousel.js') }}"></script>
@endpush
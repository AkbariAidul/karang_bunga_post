@extends('front.master')

@section('content')
    <div class="font-[Poppins] pb-[72px] bg-gray-50">
        <x-navbar />

        <div x-data="{ showModal: false }">
            <nav id="Category"
                class="max-w-[1130px] mx-auto flex justify-center items-center gap-4 flex-nowrap mt-4 mb-0 overflow-visible">
                
                {{-- PENTING: Gunakan $navCategory di sini --}}
                @foreach ($categories->take(5) as $navCategory)
                    <a href="{{ route('front.category', $navCategory->slug) }}"
                        class="rounded-full px-[18px] py-[10px] flex items-center gap-[8px] font-semibold transition-all duration-300 bg-white border border-gray-200 hover:ring-2 hover:ring-[#a0d97b] text-gray-700 shrink-0
                        {{-- Tandai kategori yang sedang aktif --}}
                        {{ $navCategory->slug == $category->slug ? 'ring-2 ring-[#68a63e]' : '' }}">
                        <div class="w-5 h-5 shrink-0">
                            <img src="{{ Storage::url($navCategory->icon) }}" alt="icon"
                                class="w-full h-full object-contain" />
                        </div>
                        <span class="truncate">{{ $navCategory->name }}</span>
                    </a>
                @endforeach

                @if ($categories->count() > 5)
                    <button @click="showModal = true" 
                            class="rounded-full px-[18px] py-[10px] flex items-center gap-[8px] font-semibold transition-all duration-300 bg-white border border-gray-200 hover:ring-2 hover:ring-[#a0d97b] text-gray-700 shrink-0">
                        <div class="w-5 h-5 shrink-0 text-[#68a63e]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </div>
                        <span>Semua Kategori</span>
                    </button>
                @endif
            </nav>

            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                @click.outside="showModal = false"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                style="display: none;">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Pilih Kategori</h3>
                        <button @click="showModal = false" class="p-1 rounded-full text-gray-400 hover:text-gray-800 hover:bg-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-[60vh] overflow-y-auto p-1">
                        @foreach ($categories as $modalCategory)
                            <a href="{{ route('front.category', $modalCategory->slug) }}"
                                class="rounded-xl p-4 flex items-center gap-3 font-semibold text-gray-700 transition-all duration-300 border border-transparent hover:border-[#407a1b] hover:bg-gray-50">
                                <div class="w-8 h-8 shrink-0">
                                    <img src="{{ Storage::url($modalCategory->icon) }}" alt="icon" class="w-full h-full object-contain" />
                                </div>
                                <span>{{ $modalCategory->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <section id="Category-result" class="max-w-[1130px] mx-auto flex flex-col items-center gap-[30px] mt-[50px] px-4">
            
            <h1 class="text-4xl leading-[45px] font-bold text-center text-gray-900">
                Explore Our <br />
                <span class="text-[#407a1b]">{{ $category->name }} News</span>
            </h1>

            <div id="search-cards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[30px] w-full">
                @forelse ($articles as $article)
                    <a href="{{ route('front.details', $article->slug) }}" class="card-news">
                        <div class="rounded-[20px] border border-gray-200 p-5 flex flex-col gap-4 hover:ring-2 hover:ring-[#407a1b] transition-all duration-300 bg-white h-full shadow-sm">
                            <div class="thumbnail-container w-full h-[200px] rounded-[12px] flex shrink-0 overflow-hidden relative bg-gray-100">
                                @if($article->category)
                                    <p class="badge-white absolute top-4 left-4 rounded-full p-[8px_18px] bg-white text-gray-800 font-bold text-xs leading-[18px] uppercase z-10">
                                        {{ $article->category->name }}
                                    </p>
                                @endif
                                <img src="{{ Storage::url($article->thumbnail) }}" class="object-cover w-full h-full" alt="thumbnail" />
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
                    <p class="col-span-1 md:col-span-3 text-center text-gray-500 text-lg py-10">
                        Belum ada berita di kategori {{ $category->name }}.
                    </p>
                @endforelse
            </div>

            <div class="mt-5 w-full">
                {{ $articles->links() }}
            </div>

            @if ($bannerads)
                <div class="w-full flex justify-center mt-[20px]">
                    <div class="flex flex-col gap-3 shrink-0 w-full max-w-[900px]">
                        <a href="{{ $bannerads->link }}">
                            <div class="w-full h-[120px] flex shrink-0 border border-gray-200 bg-white rounded-2xl overflow-hidden">
                                <img src="{{ Storage::url($bannerads->thumbnail) }}" class="object-cover w-full h-full" alt="ads" />
                            </div>
                        </a>
                        <p class="font-medium text-sm leading-[21px] text-gray-400 flex gap-1 justify-center">
                            Our Advertisement
                            <a href="#" class="w-[18px] h-[18px]">
                                <img src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" />
                            </a>
                        </p>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection
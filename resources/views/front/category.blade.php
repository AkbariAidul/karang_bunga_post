@extends('front.master')
@section('content')

<body class="font-[Poppins] pb-[83px]">
	<x-navbar/>

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

	<section id="Category-result" class="max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
		<h1 class="text-4xl leading-[45px] font-bold text-center">
			Explore Our <br />
			{{ $category->name }} News
		</h1>
		<div id="search-cards" class="grid grid-cols-3 gap-[30px]">

            @forelse ($category->news as $article)
			<a href="{{ route('front.details', $article->slug) }}" class="card">
				<div
					class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#33ff18] rounded-[20px] overflow-hidden bg-white">
					<div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
						<div
							class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
                            {{-- uppercase agar huruf besar semua --}}
							<p class="text-xs leading-[18px] font-bold uppercase">{{ $article->category->name }}</p>
						</div>
						<img src="{{ Storage::url($article->thumbnail) }}" alt="thumbnail photo"
							class="object-cover w-full h-full" />
					</div>
					<div class="flex flex-col gap-[6px]">
						<h3 class="text-lg leading-[27px] font-bold">
                            {{ substr($article->name, 0, 55) }}{{ strlen($article->name) > 55 ? '...':''}}
                        </h3>
						<p class="text-sm leading-[21px] text-[#A3A6AE]">
                            {{ $article->created_at->format('M d, Y') }}
                        </p>
					</div>
				</div>
			</a>
            @empty
                <p>belum ada berita kategori berikut</p>
            @endforelse

		</div>
	</section>
	<section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
		<div class="flex flex-col gap-3 shrink-0 w-fit">
            <a href="{{ $bannerads->link }}">
                <div class="w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
                    <img src="{{ Storage::url($bannerads->thumbnail) }}" class="object-cover w-full h-full" alt="ads" />
                </div>
            </a>
            <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
                Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img src="{{ asset('assets/images/icons/message-question.svg') }} " alt="icon" /></a>
            </p>
        </div>
	</section>
</body>

@endsection

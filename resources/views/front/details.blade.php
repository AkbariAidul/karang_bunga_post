@extends('front.master')
@section('content')

<body class="font-[Poppins]">
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
    <div x-show="showModal" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.outside="showModal = false"
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">

        <div x-show="showModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Pilih Kategori</h3>
                <button @click="showModal = false" 
                        class="p-1 rounded-full text-gray-400 hover:text-gray-800 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" 
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-[60vh] overflow-y-auto p-1">
                @foreach ($categories as $category)
                <a href="{{ route('front.category', $category->slug) }}" 
                   class="rounded-xl p-4 flex items-center gap-3 font-semibold transition-all duration-300 border border-transparent hover:border-[#EEF0F7] hover:bg-gray-50">
                    <div class="w-8 h-8 shrink-0">
                        <img src="{{ Storage::url($category->icon) }}" alt="icon" class="w-full h-full object-contain" />
                    </div>
                    <span>{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</div>

	<header class="flex flex-col items-center gap-[50px] mt-[70px]">
		<div id="Headline" class="max-w-[1130px] mx-auto flex flex-col gap-4 items-center">
			<p class="w-fit text-[#A3A6AE]">{{ $articleNews->created_at->format('M d, Y') }} • {{ $articleNews->category->name }}</p>
			<h1 id="Title" class="font-bold text-[46px] leading-[60px] text-center two-lines">
                {{ $articleNews->name }}
            </h1>
			<div class="flex items-center justify-center gap-[70px]">
				<a id="Author" href="{{ route('front.author', $articleNews->author->slug) }}" class="w-fit h-fit">
					<div class="flex items-center gap-3">
						<div class="w-10 h-10 overflow-hidden rounded-full">
							<img src="{{ Storage::url($articleNews->author->avatar) }}" class="object-cover w-full h-full" alt="avatar">
						</div>
						<div class="flex flex-col">
							<p class="font-semibold text-sm leading-[21px]">
                                {{ $articleNews->author->name }}
                            </p>
							<p class="text-xs leading-[18px] text-[#A3A6AE]">
                                {{ $articleNews->author->occupation }}
                            </p>
						</div>
					</div>
				</a>
				<div id="Rating" class="flex items-center gap-1">
					<div class="flex items-center">
						<div class="flex w-4 h-4 shrink-0">
							<img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="star">
						</div>
						<div class="flex w-4 h-4 shrink-0">
							<img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="star">
						</div>
						<div class="flex w-4 h-4 shrink-0">
							<img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="star">
						</div>
						<div class="flex w-4 h-4 shrink-0">
							<img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="star">
						</div>
						<div class="flex w-4 h-4 shrink-0">
							<img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="star">
						</div>
					</div>
					<p class="font-semibold text-xs leading-[18px]">(12,490)</p>
				</div>
			</div>
		</div>
		<div class="w-full h-[500px] flex shrink-0 overflow-hidden">
			<img src="{{ Storage::url($articleNews->thumbnail) }}" class="object-cover w-full h-full" alt="cover thumbnail">
		</div>
	</header>
	<section id="Article-container" class="max-w-[1130px] mx-auto flex gap-20 mt-[50px]">
		<article id="Content-wrapper">
			{!!  $articleNews->content !!}
		</article>
		<div class="side-bar flex flex-col w-[300px] shrink-0 gap-10">
			<div class="flex flex-col w-full gap-3 ads">
				<a href="{{ $square_ads_1->link }}">
					<img src="{{ Storage::url($square_ads_1->thumbnail) }}" class="object-contain w-full h-full" alt="ads" />
				</a>
				<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
					Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
							src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
				</p>
			</div>
			<div id="More-from-author" class="flex flex-col gap-4">
				<p class="font-bold">More From Author</p>
                @forelse ($author_news as $item_news)
                    <a href="{{ route('front.details', $item_news->slug) }}" class="card-from-author">
                        <div
                            class="rounded-[20px] ring-1 ring-[#EEF0F7] p-[14px] flex gap-4 hover:ring-2 hover:ring-[#FF6B18] transition-all duration-300">
                            <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden rounded-2xl">
                                <img src="{{ Storage::url($item_news->thumbnail) }}" class="object-cover w-full h-full"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <p class="font-bold line-clamp-2">{{ substr($item_news->name, 0, 55) }}{{ strlen($item_news->name) > 55 ? '...':''}}</p>
                                <p class="text-xs leading-[18px] text-[#A3A6AE]"> {{ $item_news->created_at->format('M d, Y') }} • {{ $item_news->category->name }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>belum ada artikel lainnya</p>
                @endforelse
			</div>
			<div class="flex flex-col w-full gap-3 ads">
				<a href="{{ $square_ads_2->link }}">
					<img src="{{ Storage::url($square_ads_2->thumbnail) }}" class="object-contain w-full h-full" alt="ads" />
				</a>
				<p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
					Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
							src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
				</p>
			</div>
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
				Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
						src="{{ asset('assets/images/icons/message-question.svg') }} " alt="icon" /></a>
			</p>
		</div>
	</section>
	<section id="Up-to-date" class="w-full flex justify-center mt-[70px] py-[50px] bg-[#F9F9FC]">
		<div class="max-w-[1130px] mx-auto flex flex-col gap-[30px]">
			<div class="flex items-center justify-between">
				<h2 class="font-bold text-[26px] leading-[39px]">
					Other News You <br />
					Might Be Interested
				</h2>
			</div>
			<div class="grid grid-cols-3 gap-[30px]">
                @forelse ($articles as $article)
                <a href="{{ route('front.details', $article->slug) }}" class="card">
                    <div
                        class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
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
                    <p>belum ada artikel lainnya</p>
                @endforelse
			</div>
		</div>
	</section>


</body>
@endsection

@push('after-styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
		rel="stylesheet" />

	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
@endpush

@push('after-scripts')
    <script src="js/two-lines-text.js"></script>
@endpush

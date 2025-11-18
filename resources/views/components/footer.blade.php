{{-- 
    TEMA HIJAU:
    - Background: #407a1b (Hijau Utama)
    - Teks: Putih
    - Border Atas: Dihilangkan atau disesuaikan
--}}
<footer class="bg-[#407a1b] pt-[60px] pb-[40px] mt-auto text-white">
    <div class="max-w-[1130px] mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10 lg:justify-between">
            
            <div class="flex flex-col gap-5 w-full lg:w-[350px]">
                <div class="flex items-center gap-[6px] shrink-0">
                    <a href="{{ route('front.index') }}" class="flex shrink-0">
                        {{-- Logo dipaksa Putih total agar kontras di atas Hijau --}}
                        <img src="{{ asset('assets/images/logos/logo.png') }}" alt="logo" class="h-10 brightness-0 invert" />
                    </a>
                </div>
                <p class="text-white/90 leading-[28px]">
                    Menyajikan berita aktual dan terpercaya seputar Desa Karang Bunga dan sekitarnya. Dari warga, untuk kemajuan bersama.
                </p>
                <div class="flex items-center gap-3">
                    {{-- 
                       Social Media Icons: 
                       - Lingkaran Putih (bg-white)
                       - Ikon Hijau (text-[#407a1b])
                       - Hover: Jadi Transparan/Hijau Muda
                    --}}
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-white hover:bg-[#a0d97b] transition-all duration-300 text-[#407a1b] hover:text-white group shadow-md">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <svg fill="currentColor" viewBox="0 0 24 24" class="w-full h-full"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373 12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </div>
                    </a>
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-white hover:bg-[#a0d97b] transition-all duration-300 text-[#407a1b] hover:text-white group shadow-md">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <svg fill="currentColor" viewBox="0 0 24 24" class="w-full h-full"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </div>
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-5">
                <p class="font-bold text-lg">Categories</p>
                <div class="flex flex-col gap-3">
                    {{-- Teks Putih dengan Hover Hijau Terang --}}
                    <a href="{{ route('front.category', 'pemerintahan') }}" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Pemerintahan</a>
                    <a href="{{ route('front.category', 'pembangunan') }}" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Pembangunan</a>
                    <a href="{{ route('front.category', 'pertanian') }}" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Pertanian</a>
                    <a href="{{ route('front.category', 'kegiatan') }}" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Kegiatan</a>
                </div>
            </div>

            <div class="flex flex-col gap-5">
                <p class="font-bold text-lg">About Us</p>
                <div class="flex flex-col gap-3">
                    <a href="#" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Tentang Kami</a>
                    <a href="#" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Hubungi Kami</a>
                    <a href="#" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Karir</a>
                    <a href="#" class="text-white/90 hover:text-[#a0d97b] hover:font-medium transition-all">Media Kit</a>
                </div>
            </div>

            <div class="flex flex-col gap-5 w-full lg:w-[250px]">
                <p class="font-bold text-lg">Contact</p>
                <p class="text-white/90 leading-[28px]">
                    Jl. Raya Karang Bunga No. 123,<br>
                    Kecamatan Mandastana,<br>
                    Barito Kuala, Kalimantan Selatan.
                </p>
                <p class="text-white/90">
                    <span class="font-semibold">Email:</span> info@karangbunga.id
                </p>
            </div>

        </div>

        <div class="w-full h-[1px] bg-[#a0d97b]/30 my-8"></div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
            <p class="text-white/80 text-sm">
                &copy; 2025 Karang Bunga Post. All Rights Reserved.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-white/80 text-sm hover:text-[#a0d97b] transition-colors">Privacy Policy</a>
                <a href="#" class="text-white/80 text-sm hover:text-[#a0d97b] transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
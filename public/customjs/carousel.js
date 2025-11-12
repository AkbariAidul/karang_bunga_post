$(document).ready(function() {

    // KODE LAMA ANDA (Hero Carousel)
    const $carousel = $('.main-carousel').flickity({
        cellAlign: 'left',
        prevNextButtons: false,
        pageDots: false,
        wrapAround: true, 
        autoPlay: 2000,
        cellSelector: '.featured-news-card'
    });

    $('.button--previous').on( 'click', function() {
      $carousel.flickity('previous');
    });

    $('.button--next').on( 'click', function() {
      $carousel.flickity('next');
    });


    // ===========================================
    // === TAMBAHKAN KODE BARU DI BAWAH INI ===
    // ===========================================
    
    // Inisialisasi untuk SEMUA carousel grid kategori
    $('.category-grid-carousel').flickity({
        cellAlign: 'left',
        contain: true,      // 'contain: true' agar tidak looping (berhenti di akhir)
        pageDots: false,    // Sembunyikan titik-titik navigasi
        prevNextButtons: true, // Tampilkan panah navigasi bawaan Flickity
        cellSelector: '.card-news' // Beri tahu Flickity bahwa slide-nya adalah '.card-news'
    });

});
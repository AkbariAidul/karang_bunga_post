<?php

namespace App\Http\Controllers;

use App\Models\ArticleNews;
use App\Models\Author;
use App\Models\BannerAdvertisment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{

    public function index(){
        $categories = Category::all();

        $articles = ArticleNews::with(['category'])
        ->where('is_featured','not_featured')
        ->latest()
        ->take(3)
        ->get();

        $featured_articles = ArticleNews::with(['category'])
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->take(3)
        ->get();

        $authors = Author::withCount('news')->get();

        $bannerads = BannerAdvertisment::where('is_active','active')
        ->where('type','banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();

        $pemerintahan_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pemerintahan');
        })
        ->where('is_featured','not_featured')
        ->latest()
        ->take(6)
        ->get();

        $pemerintahan_featured_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pemerintahan');
        })
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->first();

        $pembangunan_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pembangunan');
        })
        ->where('is_featured','not_featured')
        ->latest()
        ->take(6)
        ->get();

        $pembangunan_featured_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pembangunan');
        })
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->first();

        $pertanian_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pertanian');
        })
        ->where('is_featured','not_featured')
        ->latest()
        ->take(6)
        ->get();

        $pertanian_featured_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pertanian');
        })
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->first();
        $pertanian_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pertanian');
        })
        ->where('is_featured','not_featured')
        ->latest()
        ->take(6)
        ->get();

        $pertanian_featured_articles = ArticleNews::whereHas('category', function ($query) {
            $query->where('name', 'Pertanian');
        })
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->first();

        $lat = '-3.1667'; // Lintang Karang Bunga
        $lon = '114.5833'; // Bujur Karang Bunga
        $apiKey = env('WEATHER_API_KEY');

        // Simpan data cuaca di cache selama 2 jam (7200 detik)
        $weatherData = Cache::remember('weather_karang_bunga', 7200, function () use ($lat, $lon, $apiKey) {
            
            // Mengambil data 5 hari ke depan (setiap 3 jam)
            $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $apiKey,
                'units' => 'metric', // Menggunakan Celcius
                'lang' => 'id'      // Bahasa Indonesia
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Proses data agar rapi untuk Blade
                $today = $data['list'][0]; // Cuaca hari ini (paling dekat)

                // Filter untuk 4 hari ke depan (ambil 1 data per hari, jam 12 siang)
                $forecast = array_filter($data['list'], function ($item) {
                    return str_contains($item['dt_txt'], '12:00:00');
                });

                return [
                    'city' => $data['city']['name'],
                    'today' => $today,
                    'forecast' => array_slice($forecast, 0, 4) // Ambil 4 hari saja
                ];
            }

            return null; // Kembalikan null jika API gagal
        });

        return view('front.index', compact('weatherData','pemerintahan_articles','pemerintahan_featured_articles','pertanian_articles','pertanian_featured_articles','pembangunan_featured_articles','pembangunan_articles','categories', 'articles', 'authors', 'featured_articles', 'bannerads'));
    }

    public function category(Category $category){
        $categories = Category::all();
        $bannerads = BannerAdvertisment::where('is_active','active')
        ->where('type','banner')
        ->inRandomOrder()
        ->first();

        $articles = $category->news() // 'news()' adalah nama relasi di Model Category Anda
                            ->latest()
                            ->paginate(6);

        return view('front.category', compact('articles', 'category', 'categories', 'bannerads'));
    }

    public function author(Author $author){
        $categories = Category::all();
        $bannerads = BannerAdvertisment::where('is_active','active')
        ->where('type','banner')
        ->inRandomOrder()
        ->first();

        

        return view('front.author', compact('categories', 'author', 'bannerads'));
    }

    public function search(Request $request){

        $request->validate([
            'keyword' => ['required', 'string', 'max:255'],
        ]);

        $categories = Category::all();

        $keyword = $request->keyword;

        $articles = ArticleNews::with(['category', 'author'])
        ->where('name', 'like', '%' . $keyword . '%')->paginate(6);

        return view('front.search', compact('articles', 'keyword', 'categories'));

    }

    public function details(ArticleNews $articleNews){
        $categories = Category::all();

        $articles = ArticleNews::with(['category'])
        ->where('is_featured','not_featured')
        ->where('id', '!=', $articleNews->id)
        ->latest()
        ->take(3)
        ->get();

        $bannerads = BannerAdvertisment::where('is_active','active')
        ->where('type','banner')
        ->inRandomOrder()
        ->first();

        $square_ads = BannerAdvertisment::where('type','square')
        ->where('is_active', 'active')
        ->inRandomOrder()
        ->take(2)
        ->get();

        if($square_ads->count() < 2) {
            $square_ads_1 = $square_ads->first();
            $square_ads_2 = $square_ads->first();
            // $square_ads_2 = null;
        } else {
            $square_ads_1 = $square_ads->get(0);
            $square_ads_2 = $square_ads->get(1);
        }

        $author_news = ArticleNews::where('author_id', $articleNews->author_id)
        ->where('id', '!=', $articleNews->id)
        ->inRandomOrder()
        ->get();




        return view('front.details', compact('author_news','square_ads_1','square_ads_2' ,'articleNews', 'categories', 'articles', 'bannerads'));
    }
}

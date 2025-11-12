<?php

namespace App\Http\Controllers;

use App\Models\ArticleNews;
use App\Models\Author;
use App\Models\BannerAdvertisment;
use App\Models\Category;
use Illuminate\Http\Request;

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

        return view('front.index', compact('pembangunan_featured_articles','pembangunan_articles','categories', 'articles', 'authors', 'featured_articles', 'bannerads'));
    }

    public function category(Category $category){
        $categories = Category::all();
        $bannerads = BannerAdvertisment::where('is_active','active')
        ->where('type','banner')
        ->inRandomOrder()
        ->first();

        return view('front.category', compact('category', 'categories', 'bannerads'));
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

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hero;
use App\Models\Client;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    // Mengarahkan ke halaman Beranda
    public function home()
    {
        // 1. Mengambil data hero slider yang aktif
        $heroes = Hero::where('is_active', 1)
                      ->orderBy('order_position', 'asc')
                      ->get();

        // 2. Mengambil data logo klien yang aktif
        $clients = Client::where('is_active', 1)
                       ->orderBy('order_position', 'asc')
                       ->get();

        // 3. Mengambil data Layanan Utama yang aktif
        $services = Service::where('is_active', 1)
                         ->orderBy('order_position', 'asc')
                         ->get();

        // 4. Mengambil data Portofolio yang aktif
        $portfolios = Portfolio::where('is_active', 1)
                               ->orderBy('order_position', 'asc')
                               ->get();

        // 5. Mengambil data Testimoni / Review Klien yang aktif
        $testimonials = Testimonial::where('is_active', 1)
                                   ->orderBy('order_position', 'asc')
                                   ->get();

        // 6. Mengambil 3 Artikel (Post) terbaru yang sudah dipublikasi
        $latestPosts = Post::with(['author', 'category'])
                           ->where('status', 'published')
                           ->orderBy('created_at', 'desc')
                           ->take(3)
                           ->get();

        // Mengirimkan semua variabel ke view home
        return view('home', compact('heroes', 'clients', 'services', 'portfolios', 'testimonials', 'latestPosts'));
    }

    // Mengarahkan ke halaman Tentang Kami
    public function about()
    {
        return view('front.about');
    }

    // Mengarahkan ke halaman Layanan & Portofolio
    public function services()
    {
        $portfolios = Portfolio::where('is_active', 1)->orderBy('order_position', 'asc')->get();
        $services = Service::where('is_active', 1)->orderBy('order_position', 'asc')->get();
        
        return view('front.services', compact('portfolios', 'services'));
    }

    // Menampilkan daftar artikel (Blog Index)
    public function blogIndex()
    {
        // Mengambil post yang berstatus published beserta data relasinya
        $posts = Post::with(['author', 'category'])
                    ->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);

        return view('front.blog.index', compact('posts'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category'])->orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        // Menghitung Waktu Baca (rata-rata 200 kata per menit)
        $wordCount = str_word_count(strip_tags($request->content));
        $readingTime = ceil($wordCount / 200);

        // Handle Featured Image (Thumbnail Utama)
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('thumbnails', 'public');
        }

        $status = $request->input('action') === 'draft' ? 'draft' : 'published';

        $post = Post::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title) . '-' . time(),
            'featured_image' => $featuredImagePath,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'meta_description' => $request->meta_description,
            'tags' => $request->tags,
            'status' => $status,
            'reading_time' => $readingTime,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil disimpan!');
    }

    // Fungsi pendukung Upload Summernote & Media Library (Sama seperti sebelumnya)
    public function listImages() {
        $files = Storage::disk('public')->files('uploads');
        $images = array_map(fn($file) => ['url' => asset('storage/' . $file), 'name' => basename($file)], $files);
        return response()->json($images);
    }

    public function uploadImage(Request $request) {
        $validator = Validator::make($request->all(), ['upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120']);
        if ($validator->fails()) return response()->json(['error' => ['message' => $validator->errors()->first()]], 422);
        
        $file = $request->file('upload');
        $filename = md5_file($file->getRealPath()) . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/' . $filename;
        if (!Storage::disk('public')->exists($path)) $file->storeAs('uploads', $filename, 'public');
        
        return response()->json(['url' => asset('storage/' . $path)]);
    }
}
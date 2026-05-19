<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::orderBy('order_position', 'asc')->get();
        return view('admin.beranda.hero.index', compact('heroes'));
    }

    public function create()
    {
        // Mengirimkan instance Hero kosong agar form tidak error saat create
        $hero = new Hero();
        // Menggunakan view 'form'
        return view('admin.beranda.hero.form', compact('hero'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('beranda/hero', 'public');
            $data['image'] = $imagePath;
        }

        Hero::create($data);

        return redirect()->route('admin.beranda.hero.index')->with('success', 'Hero Image berhasil ditambahkan.');
    }

    public function edit(Hero $hero)
    {
        // Menggunakan view 'form' yang sama dengan passing data $hero
        return view('admin.beranda.hero.form', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
            $imagePath = $request->file('image')->store('beranda/hero', 'public');
            $data['image'] = $imagePath;
        }

        $hero->update($data);

        return redirect()->route('admin.beranda.hero.index')->with('success', 'Hero Image berhasil diperbarui.');
    }

    public function destroy(Hero $hero)
    {
        if ($hero->image && Storage::disk('public')->exists($hero->image)) {
            Storage::disk('public')->delete($hero->image);
        }
        
        $hero->delete();

        return redirect()->route('admin.beranda.hero.index')->with('success', 'Hero Image berhasil dihapus.');
    }
}
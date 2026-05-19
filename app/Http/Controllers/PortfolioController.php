<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('order_position', 'asc')->get();
        return view('admin.beranda.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $portfolio = new Portfolio();
        return view('admin.beranda.portfolio.form', compact('portfolio'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('beranda/portfolio', 'public');
            $data['image'] = $imagePath;
        }

        Portfolio::create($data);

        return redirect()->route('admin.beranda.portfolios.index')->with('success', 'Karya/Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.beranda.portfolio.form', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $imagePath = $request->file('image')->store('beranda/portfolio', 'public');
            $data['image'] = $imagePath;
        }

        $portfolio->update($data);

        return redirect()->route('admin.beranda.portfolios.index')->with('success', 'Karya/Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }
        
        $portfolio->delete();

        return redirect()->route('admin.beranda.portfolios.index')->with('success', 'Karya/Portofolio berhasil dihapus.');
    }
}
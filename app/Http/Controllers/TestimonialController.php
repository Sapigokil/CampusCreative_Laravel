<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order_position', 'asc')->get();
        return view('admin.beranda.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        $testimonial = new Testimonial();
        return view('admin.beranda.testimonial.form', compact('testimonial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'review' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('beranda/testimonial', 'public');
            $data['photo'] = $photoPath;
        }

        Testimonial::create($data);

        return redirect()->route('admin.beranda.testimonials.index')->with('success', 'Review Klien berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.beranda.testimonial.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'review' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $photoPath = $request->file('photo')->store('beranda/testimonial', 'public');
            $data['photo'] = $photoPath;
        }

        $testimonial->update($data);

        return redirect()->route('admin.beranda.testimonials.index')->with('success', 'Review Klien berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        
        $testimonial->delete();

        return redirect()->route('admin.beranda.testimonials.index')->with('success', 'Review Klien berhasil dihapus.');
    }
}
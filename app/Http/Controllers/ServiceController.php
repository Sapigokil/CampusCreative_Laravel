<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order_position', 'asc')->get();
        return view('admin.beranda.service.index', compact('services'));
    }

    public function create()
    {
        $service = new Service();
        return view('admin.beranda.service.form', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
            'features' => 'required|string',
            'price' => 'required|string|max:255',
            'price_strike' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('beranda/service', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        Service::create($data);

        return redirect()->route('admin.beranda.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.beranda.service.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|string|max:255',
            'features' => 'required|string',
            'price' => 'required|string|max:255',
            'price_strike' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            if ($service->thumbnail && Storage::disk('public')->exists($service->thumbnail)) {
                Storage::disk('public')->delete($service->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('beranda/service', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        $service->update($data);

        return redirect()->route('admin.beranda.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->thumbnail && Storage::disk('public')->exists($service->thumbnail)) {
            Storage::disk('public')->delete($service->thumbnail);
        }
        
        $service->delete();

        return redirect()->route('admin.beranda.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
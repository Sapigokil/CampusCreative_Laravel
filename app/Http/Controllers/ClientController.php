<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('order_position', 'asc')->get();
        return view('admin.beranda.client.index', compact('clients'));
    }

    public function create()
    {
        $client = new Client();
        return view('admin.beranda.client.form', compact('client'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('beranda/client', 'public');
            $data['logo'] = $logoPath;
        }

        Client::create($data);

        return redirect()->route('admin.beranda.clients.index')->with('success', 'Logo Klien berhasil ditambahkan.');
    }

    public function edit(Client $client)
    {
        return view('admin.beranda.client.form', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'order_position' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }
            $logoPath = $request->file('logo')->store('beranda/client', 'public');
            $data['logo'] = $logoPath;
        }

        $client->update($data);

        return redirect()->route('admin.beranda.clients.index')->with('success', 'Logo Klien berhasil diperbarui.');
    }

    public function destroy(Client $client)
    {
        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }
        
        $client->delete();

        return redirect()->route('admin.beranda.clients.index')->with('success', 'Logo Klien berhasil dihapus.');
    }
}
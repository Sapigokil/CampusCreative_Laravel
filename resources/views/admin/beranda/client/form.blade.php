@extends('layouts.main')

@section('title', $client->exists ? 'Edit Logo Klien' : 'Tambah Logo Klien')

@push('styles')
<style>
    .form-container { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); max-width: 800px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
    .form-control { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: sans-serif; }
    .form-control:focus { outline: none; border-color: #007bff; }
    .btn { padding: 10px 20px; border-radius: 4px; color: white; border: none; cursor: pointer; text-decoration: none; display: inline-block; }
    .btn-primary { background-color: #007bff; }
    .btn-secondary { background-color: #6c757d; }
    .text-danger { color: #dc3545; font-size: 12px; margin-top: 5px; display: block; }
    .img-preview { margin-top: 10px; border-radius: 4px; border: 1px solid #ddd; padding: 10px; background: #f9f9f9; object-fit: contain; }
    .alert-info { background-color: #e2e3e5; color: #383d41; padding: 12px 15px; border-radius: 6px; font-size: 0.9rem; margin-bottom: 15px; border-left: 4px solid #6c757d; }
</style>
@endpush

@section('content')
<div style="margin-bottom: 20px;">
    <h2>{{ $client->exists ? 'Edit Logo Klien / Mitra' : 'Tambah Logo Klien / Mitra Baru' }}</h2>
</div>

<div class="form-container">
    <form action="{{ $client->exists ? route('admin.beranda.clients.update', $client->id) : route('admin.beranda.clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($client->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Nama Klien / Instansi *</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name) }}" required placeholder="Contoh: PT. Solusi Digital">
            <small style="color: #666; font-size:12px;">Digunakan sebagai alt text gambar untuk SEO.</small>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="logo">File Logo *</label>
            
            <div class="alert-info">
                <strong>💡 Panduan Resolusi Logo:</strong><br>
                Disarankan menggunakan format <strong>PNG transparan</strong> atau <strong>SVG</strong> agar menyatu dengan background putih. Ukuran dimensi tidak perlu terlalu besar (misal 300x150px) dengan ukuran file maksimal 2MB.
            </div>

            <input type="file" name="logo" id="logo" class="form-control" accept="image/png, image/jpeg, image/webp, image/svg+xml" {{ $client->exists ? '' : 'required' }}>
            
            @if($client->exists && $client->logo)
                <div style="margin-top: 10px;">
                    <span style="font-size: 12px; color:#666;">Logo Saat Ini:</span><br>
                    <img src="{{ asset('storage/' . $client->logo) }}" alt="Preview" width="150" height="80" class="img-preview">
                </div>
            @endif
            
            @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="order_position">Urutan Tampil *</label>
                <input type="number" name="order_position" id="order_position" class="form-control" value="{{ old('order_position', $client->order_position ?? 1) }}" required>
                @error('order_position') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="is_active">Status Tampil *</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1" {{ old('is_active', $client->is_active ?? 1) == '1' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                    <option value="0" {{ old('is_active', $client->is_active) === 0 ? 'selected' : '' }}>Sembunyikan</option>
                </select>
                @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">{{ $client->exists ? 'Perbarui Data' : 'Simpan Data' }}</button>
            <a href="{{ route('admin.beranda.clients.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
@extends('layouts.main')

@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')

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
    .img-preview { margin-top: 10px; border-radius: 4px; border: 1px solid #ddd; padding: 5px; background: #f9f9f9; object-fit: cover; }
    .alert-info { background-color: #e2e3e5; color: #383d41; padding: 12px 15px; border-radius: 6px; font-size: 0.9rem; margin-bottom: 15px; border-left: 4px solid #6c757d; }
</style>
@endpush

@section('content')
<div style="margin-bottom: 20px;">
    <h2>{{ $service->exists ? 'Edit Layanan Utama' : 'Tambah Layanan Utama Baru' }}</h2>
</div>

<div class="form-container">
    <form action="{{ $service->exists ? route('admin.beranda.services.update', $service->id) : route('admin.beranda.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($service->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Judul / Nama Layanan *</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $service->title) }}" required placeholder="Contoh: Website Development">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="thumbnail">Gambar Thumbnail *</label>
            
            <div class="alert-info">
                <strong>💡 Resolusi yang disarankan:</strong> Format persegi panjang mendatar (misal 600x400px). Gambar ini akan berada di bagian teratas dalam Card Layanan.
            </div>

            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*" {{ $service->exists ? '' : 'required' }}>
            
            @if($service->exists && $service->thumbnail)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="Preview" width="200" height="120" class="img-preview">
                </div>
            @endif
            
            @error('thumbnail') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="features">Daftar Ceklist Layanan *</label>
            <div class="alert-info" style="font-size: 13px; padding: 8px 12px;">
                Pisahkan setiap poin ceklist dengan baris baru (<strong>Tekan Enter</strong>). Sistem otomatis akan membuatkan ikon centang (✓) di depannya.
            </div>
            <textarea name="features" id="features" class="form-control" rows="5" required placeholder="Company Profile & Toko Online&#10;Sistem Informasi Kompleks&#10;Arsitektur API & Optimasi SEO">{{ old('features', $service->features) }}</textarea>
            @error('features') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="price">Harga Tampil (Saat Ini) *</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $service->price) }}" required placeholder="Contoh: Rp 1.500.000">
                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="price_strike">Harga Coret (Sebelum Diskon)</label>
                <input type="text" name="price_strike" id="price_strike" class="form-control" value="{{ old('price_strike', $service->price_strike) }}" placeholder="Contoh: Rp 2.000.000 (Opsional)">
                <small style="color: #666; font-size:12px;">Biarkan kosong jika tidak ada diskon.</small>
                @error('price_strike') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="button_url">URL / Link Halaman Paket (Opsional)</label>
            <input type="text" name="button_url" id="button_url" class="form-control" value="{{ old('button_url', $service->button_url) }}" placeholder="Contoh: /layanan/web-development">
            @error('button_url') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="order_position">Urutan Tampil *</label>
                <input type="number" name="order_position" id="order_position" class="form-control" value="{{ old('order_position', $service->order_position ?? 1) }}" required>
                @error('order_position') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="is_active">Status Publikasi *</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1" {{ old('is_active', $service->is_active ?? 1) == '1' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                    <option value="0" {{ old('is_active', $service->is_active) === 0 ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                </select>
                @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">{{ $service->exists ? 'Perbarui Data' : 'Simpan Data' }}</button>
            <a href="{{ route('admin.beranda.services.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
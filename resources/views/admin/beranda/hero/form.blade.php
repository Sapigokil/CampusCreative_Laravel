@extends('layouts.main')

@section('title', $hero->exists ? 'Edit Hero Image' : 'Tambah Hero Image')

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
    .img-preview { margin-top: 10px; border-radius: 4px; border: 1px solid #ddd; padding: 5px; background: #f9f9f9; }
    .alert-info { background-color: #e2e3e5; color: #383d41; padding: 12px 15px; border-radius: 6px; font-size: 0.9rem; margin-bottom: 15px; border-left: 4px solid #6c757d; }
</style>
@endpush

@section('content')
<div style="margin-bottom: 20px;">
    <h2>{{ $hero->exists ? 'Edit Hero Image (Slider)' : 'Tambah Hero Image (Slider) Baru' }}</h2>
</div>

<div class="form-container">
    <form action="{{ $hero->exists ? route('admin.beranda.hero.update', $hero->id) : route('admin.beranda.hero.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($hero->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="image">File Gambar Slider *</label>
            
            <div class="alert-info">
                <strong>💡 Panduan Resolusi Gambar:</strong><br>
                Agar tampilan optimal dan tidak pecah, gunakan gambar dengan rasio <strong>16:9</strong> (Landscape) atau resolusi minimum <strong>1280x720 pixel</strong>. Format yang diizinkan: JPG, PNG, atau WEBP. Maksimal ukuran file: 2MB.
            </div>

            <input type="file" name="image" id="image" class="form-control" accept="image/*" {{ $hero->exists ? '' : 'required' }}>
            
            @if($hero->exists && $hero->image)
                <div style="margin-top: 10px;">
                    <span style="font-size: 12px; color:#666;">Gambar Saat Ini:</span><br>
                    <img src="{{ asset('storage/' . $hero->image) }}" alt="Preview" width="250" class="img-preview">
                </div>
            @endif
            
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="title">Judul Teks Besar (Opsional)</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $hero->title) }}" placeholder="Contoh: Agensi Digital Terbaik">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="subtitle">Sub Judul / Deskripsi (Opsional)</label>
            <textarea name="subtitle" id="subtitle" class="form-control" rows="3" placeholder="Contoh: Kami membantu mendigitalisasi bisnis Anda...">{{ old('subtitle', $hero->subtitle) }}</textarea>
            @error('subtitle') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="button_text">Teks Tombol</label>
                <input type="text" name="button_text" id="button_text" class="form-control" value="{{ old('button_text', $hero->button_text) }}" placeholder="Contoh: Konsultasi Sekarang">
                @error('button_text') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="button_url">URL / Link Tombol</label>
                <input type="text" name="button_url" id="button_url" class="form-control" value="{{ old('button_url', $hero->button_url) }}" placeholder="Contoh: https://wa.me/...">
                @error('button_url') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="order_position">Urutan Tampil *</label>
                <input type="number" name="order_position" id="order_position" class="form-control" value="{{ old('order_position', $hero->order_position ?? 1) }}" required>
                @error('order_position') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="is_active">Status Publikasi *</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1" {{ old('is_active', $hero->is_active ?? 1) == '1' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                    <option value="0" {{ old('is_active', $hero->is_active) === 0 ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                </select>
                @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">{{ $hero->exists ? 'Perbarui Data' : 'Simpan Data' }}</button>
            <a href="{{ route('admin.beranda.hero.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
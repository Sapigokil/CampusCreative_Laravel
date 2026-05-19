@extends('layouts.main')

@section('title', $portfolio->exists ? 'Edit Portofolio' : 'Tambah Portofolio')

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
    <h2>{{ $portfolio->exists ? 'Edit Portofolio / Karya' : 'Tambah Portofolio / Karya Baru' }}</h2>
</div>

<div class="form-container">
    <form action="{{ $portfolio->exists ? route('admin.beranda.portfolios.update', $portfolio->id) : route('admin.beranda.portfolios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($portfolio->exists)
            @method('PUT')
        @endif

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 2;">
                <label for="title">Judul Proyek *</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required placeholder="Contoh: Aplikasi E-Rapor Sekolah">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="category">Kategori / Layanan *</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $portfolio->category) }}" required placeholder="Contoh: Sistem Informasi">
                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Gambar Mockup / Screenshot *</label>
            
            <div class="alert-info">
                <strong>💡 Resolusi yang disarankan:</strong> Format mendatar/landscape (misal: 800x600px). Gambar ini akan otomatis disesuaikan ukurannya ke dalam Card Portofolio.
            </div>

            <input type="file" name="image" id="image" class="form-control" accept="image/*" {{ $portfolio->exists ? '' : 'required' }}>
            
            @if($portfolio->exists && $portfolio->image)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Preview" width="250" height="150" class="img-preview">
                </div>
            @endif
            
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="link">URL / Link Proyek (Opsional)</label>
            <input type="text" name="link" id="link" class="form-control" value="{{ old('link', $portfolio->link) }}" placeholder="Contoh: https://klien-website.com">
            <small style="color: #666; font-size:12px;">Biarkan kosong jika proyek bersifat rahasia/internal.</small>
            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="order_position">Urutan Tampil *</label>
                <input type="number" name="order_position" id="order_position" class="form-control" value="{{ old('order_position', $portfolio->order_position ?? 1) }}" required>
                @error('order_position') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="is_active">Status Publikasi *</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1" {{ old('is_active', $portfolio->is_active ?? 1) == '1' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                    <option value="0" {{ old('is_active', $portfolio->is_active) === 0 ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                </select>
                @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">{{ $portfolio->exists ? 'Perbarui Data' : 'Simpan Data' }}</button>
            <a href="{{ route('admin.beranda.portfolios.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
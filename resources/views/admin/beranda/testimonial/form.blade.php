@extends('layouts.main')

@section('title', $testimonial->exists ? 'Edit Review Klien' : 'Tambah Review Klien')

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
    .img-preview { margin-top: 10px; border-radius: 50%; border: 2px solid #ddd; padding: 2px; background: #fff; object-fit: cover; }
</style>
@endpush

@section('content')
<div style="margin-bottom: 20px;">
    <h2>{{ $testimonial->exists ? 'Edit Review / Testimoni' : 'Tambah Review / Testimoni Baru' }}</h2>
</div>

<div class="form-container">
    <form action="{{ $testimonial->exists ? route('admin.beranda.testimonials.update', $testimonial->id) : route('admin.beranda.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($testimonial->exists)
            @method('PUT')
        @endif

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="name">Nama Klien / Reviewer *</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required placeholder="Contoh: Budi Santoso">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="instansi">Instansi / Jabatan *</label>
                <input type="text" name="instansi" id="instansi" class="form-control" value="{{ old('instansi', $testimonial->instansi) }}" required placeholder="Contoh: CEO PT. Solusi Maju">
                @error('instansi') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="review">Teks Review / Testimoni *</label>
            <textarea name="review" id="review" class="form-control" rows="5" required placeholder="Tuliskan ulasan dari klien di sini...">{{ old('review', $testimonial->review) }}</textarea>
            @error('review') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="photo">Foto Klien (Opsional)</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            <small style="color: #666; font-size:12px;">Disarankan menggunakan gambar rasio 1:1 (persegi). Jika dikosongkan, akan otomatis menggunakan inisial nama.</small>
            
            @if($testimonial->exists && $testimonial->photo)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Preview" width="80" height="80" class="img-preview">
                </div>
            @endif
            
            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="order_position">Urutan Tampil *</label>
                <input type="number" name="order_position" id="order_position" class="form-control" value="{{ old('order_position', $testimonial->order_position ?? 1) }}" required>
                @error('order_position') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div style="flex: 1;">
                <label for="is_active">Status Publikasi *</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1" {{ old('is_active', $testimonial->is_active ?? 1) == '1' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                    <option value="0" {{ old('is_active', $testimonial->is_active) === 0 ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                </select>
                @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">{{ $testimonial->exists ? 'Perbarui Data' : 'Simpan Data' }}</button>
            <a href="{{ route('admin.beranda.testimonials.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
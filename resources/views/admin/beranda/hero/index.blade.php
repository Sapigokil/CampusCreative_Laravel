@extends('layouts.main')

@section('title', 'Kelola Hero Image')

@push('styles')
<style>
    .header-action { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .btn { padding: 10px 15px; border-radius: 4px; text-decoration: none; color: white; border: none; cursor: pointer; font-size: 14px; }
    .btn-primary { background-color: #007bff; }
    .btn-primary:hover { background-color: #0056b3; }
    .btn-warning { background-color: #ffc107; color: black; }
    .btn-danger { background-color: #dc3545; }
    .table-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); overflow-x: auto; }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 12px 15px; border-bottom: 1px solid #ddd; text-align: left; }
    .table th { background-color: #f8f9fa; font-weight: bold; color: #333; }
    .badge-success { background-color: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; }
    .badge-secondary { background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; }
    .img-thumbnail { border-radius: 4px; object-fit: cover; }
    .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
</style>
@endpush

@section('content')
<div class="header-action">
    <h2>Manajemen Hero Image (Slider)</h2>
    <a href="{{ route('admin.beranda.hero.create') }}" class="btn btn-primary">+ Tambah Hero Baru</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Urutan</th>
                <th style="width: 150px;">Gambar</th>
                <th>Judul & Tombol</th>
                <th>Status</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($heroes as $hero)
            <tr>
                <td>{{ $hero->order_position }}</td>
                <td>
                    <img src="{{ asset('storage/' . $hero->image) }}" alt="Hero Image" width="120" height="70" class="img-thumbnail">
                </td>
                <td>
                    <strong>{{ $hero->title ?: 'Tidak Ada Judul' }}</strong><br>
                    <small style="color: #666;">URL: {{ $hero->button_url ?: '-' }}</small>
                </td>
                <td>
                    @if($hero->is_active)
                        <span class="badge-success">Aktif</span>
                    @else
                        <span class="badge-secondary">Draft</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.beranda.hero.edit', $hero->id) }}" class="btn btn-warning" style="padding: 6px 12px; font-size:12px;">Edit</a>
                    <form action="{{ route('admin.beranda.hero.destroy', $hero->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size:12px;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #888;">Belum ada data hero slider yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
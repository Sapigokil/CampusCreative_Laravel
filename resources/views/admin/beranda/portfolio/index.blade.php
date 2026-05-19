@extends('layouts.main')

@section('title', 'Kelola Portofolio')

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
    .table th, .table td { padding: 12px 15px; border-bottom: 1px solid #ddd; text-align: left; vertical-align: middle; }
    .table th { background-color: #f8f9fa; font-weight: bold; color: #333; }
    .badge-success { background-color: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; }
    .badge-secondary { background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; }
    .img-thumb { border-radius: 4px; object-fit: cover; }
    .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
</style>
@endpush

@section('content')
<div class="header-action">
    <h2>Manajemen Portofolio / Karya</h2>
    <a href="{{ route('admin.beranda.portfolios.create') }}" class="btn btn-primary">+ Tambah Portofolio</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Urutan</th>
                <th style="width: 150px;">Gambar Layar</th>
                <th>Judul Proyek</th>
                <th>Kategori</th>
                <th>Status</th>
                <th style="width: 130px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($portfolios as $portfolio)
            <tr>
                <td>{{ $portfolio->order_position }}</td>
                <td>
                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Preview" width="120" height="70" class="img-thumb">
                </td>
                <td>
                    <strong>{{ $portfolio->title }}</strong>
                </td>
                <td>
                    <span style="color: #007bff; font-weight: bold; font-size: 13px;">{{ $portfolio->category }}</span>
                </td>
                <td>
                    @if($portfolio->is_active)
                        <span class="badge-success">Aktif</span>
                    @else
                        <span class="badge-secondary">Draft</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.beranda.portfolios.edit', $portfolio->id) }}" class="btn btn-warning" style="padding: 6px 12px; font-size:12px;">Edit</a>
                    <form action="{{ route('admin.beranda.portfolios.destroy', $portfolio->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portofolio ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size:12px;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #888;">Belum ada portofolio yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
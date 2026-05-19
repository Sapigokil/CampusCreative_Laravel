@extends('layouts.main')

@section('title', 'Kelola Layanan Utama')

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
    .price-strike { text-decoration: line-through; color: #dc3545; font-size: 12px; margin-right: 5px; }
</style>
@endpush

@section('content')
<div class="header-action">
    <h2>Manajemen Layanan Utama</h2>
    <a href="{{ route('admin.beranda.services.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width: 120px;">Thumbnail</th>
                <th>Info Layanan</th>
                <th>Harga</th>
                <th>Status</th>
                <th style="width: 130px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td>{{ $service->order_position }}</td>
                <td>
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="Thumbnail" width="100" height="60" class="img-thumb">
                </td>
                <td>
                    <strong>{{ $service->title }}</strong><br>
                    <small style="color: #666;">
                        {{ count(array_filter(explode("\n", str_replace("\r", "", $service->features)))) }} Poin Ceklist
                    </small>
                </td>
                <td>
                    @if($service->price_strike)
                        <span class="price-strike">{{ $service->price_strike }}</span><br>
                    @endif
                    <strong style="color: #28a745;">{{ $service->price }}</strong>
                </td>
                <td>
                    @if($service->is_active)
                        <span class="badge-success">Aktif</span>
                    @else
                        <span class="badge-secondary">Draft</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.beranda.services.edit', $service->id) }}" class="btn btn-warning" style="padding: 6px 12px; font-size:12px;">Edit</a>
                    <form action="{{ route('admin.beranda.services.destroy', $service->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size:12px;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #888;">Belum ada data layanan yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
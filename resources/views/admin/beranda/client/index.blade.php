@extends('layouts.main')

@section('title', 'Kelola Logo Klien')

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
    .img-logo { border-radius: 4px; object-fit: contain; background-color: #f9f9f9; padding: 5px; border: 1px solid #eee; }
    .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
</style>
@endpush

@section('content')
<div class="header-action">
    <h2>Manajemen Logo Klien / Mitra</h2>
    <a href="{{ route('admin.beranda.clients.create') }}" class="btn btn-primary">+ Tambah Logo Klien</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 80px;">Urutan</th>
                <th style="width: 150px;">Logo</th>
                <th>Nama Klien / Instansi</th>
                <th>Status</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
            <tr>
                <td>{{ $client->order_position }}</td>
                <td>
                    <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" width="100" height="50" class="img-logo">
                </td>
                <td>
                    <strong>{{ $client->name }}</strong>
                </td>
                <td>
                    @if($client->is_active)
                        <span class="badge-success">Aktif</span>
                    @else
                        <span class="badge-secondary">Sembunyi</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.beranda.clients.edit', $client->id) }}" class="btn btn-warning" style="padding: 6px 12px; font-size:12px;">Edit</a>
                    <form action="{{ route('admin.beranda.clients.destroy', $client->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data logo ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size:12px;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #888;">Belum ada logo klien yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
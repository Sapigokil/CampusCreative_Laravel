@extends('layouts.main')

@section('title', 'Kelola Review Klien')

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
    .img-circle { border-radius: 50%; object-fit: cover; border: 2px solid #eee; }
    .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
    .avatar-placeholder { width: 50px; height: 50px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-weight: bold; font-size: 18px; }
</style>
@endpush

@section('content')
<div class="header-action">
    <h2>Manajemen Review / Testimoni Klien</h2>
    <a href="{{ route('admin.beranda.testimonials.create') }}" class="btn btn-primary">+ Tambah Review</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width: 80px;">Foto</th>
                <th>Nama & Instansi</th>
                <th>Isi Review</th>
                <th>Status</th>
                <th style="width: 130px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $testi)
            <tr>
                <td>{{ $testi->order_position }}</td>
                <td>
                    @if($testi->photo)
                        <img src="{{ asset('storage/' . $testi->photo) }}" alt="Foto" width="50" height="50" class="img-circle">
                    @else
                        <div class="avatar-placeholder">{{ strtoupper(substr($testi->name, 0, 1)) }}</div>
                    @endif
                </td>
                <td>
                    <strong>{{ $testi->name }}</strong><br>
                    <span style="font-size: 12px; color: #666;">{{ $testi->instansi }}</span>
                </td>
                <td>
                    <span style="font-size: 13px; color: #555;">{{ Str::limit($testi->review, 50) }}</span>
                </td>
                <td>
                    @if($testi->is_active)
                        <span class="badge-success">Aktif</span>
                    @else
                        <span class="badge-secondary">Draft</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.beranda.testimonials.edit', $testi->id) }}" class="btn btn-warning" style="padding: 6px 12px; font-size:12px;">Edit</a>
                    <form action="{{ route('admin.beranda.testimonials.destroy', $testi->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus review ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size:12px;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #888;">Belum ada review klien yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
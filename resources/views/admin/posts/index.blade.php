@extends('layouts.main')

@section('title', 'Semua Artikel')

@push('styles')
<style>
    .header-index { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .btn-new { background: #000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; }
    .btn-new:hover { background: #333; }
    
    .table-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; padding: 12px; border-bottom: 2px solid #eee; background: #fafafa; }
    td { padding: 12px; border-bottom: 1px solid #eee; vertical-align: top; }
    
    .post-title { font-weight: bold; color: #000; text-decoration: none; display: block; margin-bottom: 5px; }
    .post-actions { font-size: 13px; visibility: hidden; }
    tr:hover .post-actions { visibility: visible; }
    
    .post-actions a, .post-actions button { color: #007bff; text-decoration: none; background: none; border: none; padding: 0; cursor: pointer; font-size: 13px; margin-right: 10px; }
    .post-actions .btn-delete { color: #dc3545; }
    .post-actions .btn-archive { color: #6c757d; }
    
    .badge { padding: 4px 8px; border-radius: 4px; font-size: 11px; text-transform: uppercase; font-weight: bold; }
    .badge-published { background: #d4edda; color: #155724; }
    .badge-draft { background: #fff3cd; color: #856404; }
    .badge-archived { background: #f8d7da; color: #721c24; }
</style>
@endpush

@section('content')
<div class="header-index">
    <h2 style="margin: 0;">Artikel</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn-new">Tambah Baru</a>
</div>

@if(session('success'))
    <div style="padding: 15px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th style="width: 150px;">Contributor</th>
                <th style="width: 150px;">Status</th>
                <th style="width: 180px;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    <a href="#" class="post-title">{{ $post->title }}</a>
                    <div class="post-actions">
                        <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                        
                        <button type="button" onclick="copyUrl('{{ url('/artikel/'.$post->slug) }}')">Copy URL</button>
                        
                        @if($post->status != 'archived')
                        <form action="{{ route('admin.posts.archive', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-archive">Arsip</button>
                        </form>
                        @endif

                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus artikel ini selamanya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </div>
                </td>
                <td>{{ $post->author->name ?? 'Anonim' }}</td>
                <td>
                    <span class="badge badge-{{ $post->status }}">
                        {{ $post->status }}
                    </span>
                </td>
                <td>
                    {{ $post->created_at->format('d/m/Y') }}<br>
                    <small style="color: #999;">{{ $post->created_at->diffForHumans() }}</small>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 40px; color: #999;">Belum ada artikel yang dibuat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    function copyUrl(url) {
        navigator.clipboard.writeText(url).then(function() {
            alert('URL berhasil disalin ke clipboard!');
        }, function(err) {
            console.error('Gagal menyalin URL: ', err);
        });
    }
</script>
@endpush
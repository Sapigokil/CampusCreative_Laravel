@extends('layouts.front')

@section('title', 'Artikel & Wawasan Digital | Campus Creative')
@section('meta_description', 'Kumpulan artikel terbaru, tips SEO, dan wawasan seputar teknologi website dari tim ahli Campus Creative Semarang.')

@push('styles')
<style>
    /* Hero Blog Section */
    .blog-hero {
        background-color: var(--color-dark-grey);
        color: var(--color-white);
        padding: 5rem 2rem;
        text-align: center;
        border-bottom: 4px solid var(--color-orange);
    }
    .blog-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        font-weight: 800;
    }
    .blog-hero p {
        font-size: 1.15rem;
        color: #cccccc;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Grid & Card Artikel */
    .blog-container {
        padding: 5rem 2rem;
        background-color: var(--color-white-off);
    }
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2.5rem;
    }
    .blog-card {
        background-color: var(--color-white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.04);
        border: 1px solid #eaeaea;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
    
    /* Gambar Thumbnail */
    .blog-img-wrapper {
        position: relative;
        height: 220px;
        background-color: #eee;
        overflow: hidden;
    }
    .blog-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .blog-card:hover .blog-img {
        transform: scale(1.05);
    }
    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: var(--color-orange);
        color: var(--color-white);
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    /* Konten Card */
    .blog-content {
        padding: 1.8rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .blog-meta {
        font-size: 0.85rem;
        color: var(--color-grey-light);
        margin-bottom: 0.8rem;
        display: flex;
        gap: 15px;
    }
    .blog-title {
        font-size: 1.3rem;
        color: var(--color-dark-grey);
        margin: 0 0 1rem 0;
        font-weight: 800;
        line-height: 1.4;
    }
    .blog-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s;
    }
    .blog-title a:hover {
        color: var(--color-orange);
    }
    .blog-excerpt {
        font-size: 0.95rem;
        color: var(--color-grey-light);
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }
    .blog-footer {
        border-top: 1px solid #eee;
        padding-top: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
    }
    .read-more {
        color: var(--color-orange);
        font-weight: bold;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }
    .blog-card:hover .read-more {
        gap: 10px; /* Efek panah bergeser saat di-hover */
    }

    /* Paginasi */
    .pagination-wrapper {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .blog-hero { padding: 4rem 1.5rem; }
        .blog-hero h1 { font-size: 2.2rem; }
        .blog-container { padding: 3rem 1.5rem; }
    }
</style>
@endpush

@section('content')
    <section class="blog-hero">
        <div class="container">
            <h1>Artikel & Wawasan</h1>
            <p>Eksplorasi strategi digital, tips teknis, dan pembaruan terbaru dari industri teknologi untuk mendukung pertumbuhan bisnis Anda.</p>
        </div>
    </section>

    <section class="blog-container">
        <div class="container">
            <div class="blog-grid">
                
                @forelse($posts as $post)
                    <article class="blog-card">
                        <div class="blog-img-wrapper">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="blog-img">
                            @else
                                <div class="blog-img" style="background-color: var(--color-dark-grey); display:flex; align-items:center; justify-content:center; color:white;">
                                    <span>Campus Creative</span>
                                </div>
                            @endif
                            
                            <span class="category-badge">{{ $post->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span>📅 {{ $post->created_at->format('d M Y') }}</span>
                                <span>⏱️ {{ $post->reading_time ?? 1 }} min read</span>
                            </div>
                            
                            <h2 class="blog-title">
                                <a href="#">{{ $post->title }}</a>
                            </h2>
                            
                            <p class="blog-excerpt">
                                @if($post->excerpt)
                                    {{ Str::limit($post->excerpt, 120) }}
                                @else
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                @endif
                            </p>
                            
                            <div class="blog-footer">
                                <span style="color: var(--color-dark-grey); font-weight: 600;">
                                    ✍️ {{ $post->author->name ?? 'Tim Campus' }}
                                </span>
                                <a href="#" class="read-more">Baca Selengkapnya &rarr;</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; background: var(--color-white); border-radius: 8px; border: 1px dashed #ccc;">
                        <h3 style="color: var(--color-dark-grey);">Belum Ada Artikel</h3>
                        <p style="color: var(--color-grey-light);">Artikel yang Anda terbitkan akan muncul di sini.</p>
                    </div>
                @endforelse

            </div>

            <div class="pagination-wrapper">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
@extends('layouts.front')

@section('title', 'Layanan & Portofolio | Campus Creative')

@push('styles')
<style>
    /* ==========================================================================
       Variabel Warna & Base Layout
       ========================================================================== */
    :root {
        --color-dark-grey: #0f1115;
        --color-dark-card: #181b22;
        --color-orange: #ff6b00;
        --color-orange-hover: #e05e00;
        --color-white: #ffffff;
        --color-white-off: #f8fafc;
        --color-grey-text: #475569;
        --color-grey-light: #94a3b8;
        --color-border: #e2e8f0;
        --max-width-canvas: 1440px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', system-ui, -apple-system, sans-serif; color: var(--color-dark-grey); background-color: var(--color-white); overflow-x: hidden; }
    .wide-container { max-width: var(--max-width-canvas); margin: 0 auto; padding: 0 40px; }
    .text-center { text-align: center; }

    /* ==========================================================================
       1. Portofolio Section (Bertindak sebagai Hero Halaman)
       ========================================================================== */
    .portofolio-page-section { 
        background: radial-gradient(circle at 50% 0%, #1e222b 0%, var(--color-dark-grey) 100%);
        padding: 11rem 0 10rem 0; 
        color: var(--color-white); 
    }
    .section-header { margin-bottom: 5rem; text-align: center; }
    .section-header h1 { font-size: 3.8rem; font-weight: 900; margin-bottom: 1.5rem; letter-spacing: -1.5px; color: var(--color-white); }
    .portofolio-page-section .section-header p { color: #cbd5e1; font-size: 1.25rem; max-width: 800px; margin: 0 auto; line-height: 1.7; text-align: center; }

    .porto-grid-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin: 0 auto; width: 100%; }
    .porto-grid-item { display: flex; flex-direction: column; flex-grow: 1; flex-basis: 100%; max-width: 100%; }
    @media (min-width: 768px) { .porto-grid-item { flex-basis: calc(50% - 15px); max-width: calc(50% - 15px); } }
    @media (min-width: 1200px) { .porto-grid-item { flex-basis: calc(33.333% - 20px); max-width: calc(33.333% - 20px); } }

    .card-portfolio-modern { 
        background-color: var(--color-dark-card); 
        border-radius: 24px; 
        overflow: hidden; 
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); 
        border: 1px solid rgba(255,255,255,0.04); 
        display: flex; 
        flex-direction: column; 
        height: 100%; 
        width: 100%; 
        text-decoration: none; 
    }
    .card-portfolio-modern:hover { transform: translateY(-8px); border-color: rgba(255, 107, 0, 0.5); box-shadow: 0 30px 60px rgba(0,0,0,0.5); }
    .portfolio-screen-dump { height: 280px; background-color: #1f232d; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .portfolio-screen-dump img { width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.6s ease; }
    .card-portfolio-modern:hover .portfolio-screen-dump img { transform: scale(1.05); }
    .portfolio-meta-body { padding: 2.5rem; flex-grow: 1; }
    .portfolio-meta-body h4 { margin-bottom: 0.8rem; color: var(--color-white); font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; line-height: 1.4; }
    .portfolio-meta-body p { color: var(--color-orange); font-size: 0.95rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin: 0; }

    /* ==========================================================================
       2. Layanan Section (Terang & Bersih)
       ========================================================================== */
    .layanan-page-section { background-color: var(--color-white-off); padding: 9rem 0; border-top: 4px solid var(--color-orange); }
    .layanan-page-section .section-header h2 { font-size: 3.2rem; font-weight: 900; margin-bottom: 1.5rem; letter-spacing: -1.5px; color: var(--color-dark-grey); }
    .layanan-page-section .section-header p { color: var(--color-grey-text); font-size: 1.25rem; max-width: 800px; margin: 0 auto; line-height: 1.7; text-align: center; }

    .layanan-grid-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin: 0 auto; width: 100%; }
    .layanan-grid-item { display: flex; flex-direction: column; flex-grow: 1; flex-basis: 100%; max-width: 100%; }
    @media (min-width: 768px) { .layanan-grid-item { flex-basis: calc(50% - 15px); max-width: calc(50% - 15px); } }
    @media (min-width: 1200px) { .layanan-grid-item { flex-basis: calc(25% - 22.5px); max-width: calc(25% - 22.5px); } }
    
    .card-service-premium { background-color: var(--color-white); border-radius: 24px; padding: 0; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02); border: 1px solid var(--color-border); transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); display: flex; flex-direction: column; height: 100%; width: 100%; }
    .card-service-premium:hover { transform: translateY(-12px); box-shadow: 0 30px 60px -15px rgba(255, 107, 0, 0.15); border-color: var(--color-orange); }
    .service-thumbnail-node { height: 220px; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--color-border); overflow: hidden; }
    .service-thumbnail-node img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .card-service-premium:hover .service-thumbnail-node img { transform: scale(1.08); }
    .service-body-node { padding: 3rem 2.5rem; display: flex; flex-direction: column; flex-grow: 1; }
    .service-body-node h3 { font-size: 1.6rem; color: var(--color-dark-grey); margin-bottom: 1.5rem; font-weight: 800; letter-spacing: -0.5px; }
    .service-body-node ul { list-style: none; margin-bottom: 3rem; flex-grow: 1; padding: 0; }
    .service-body-node ul li { position: relative; padding-left: 2rem; margin-bottom: 1.2rem; color: var(--color-grey-text); font-size: 1.05rem; line-height: 1.6; text-align: justify; }
    .service-body-node ul li::before { content: "✓"; color: var(--color-orange); position: absolute; left: 0; font-weight: 900; font-size: 1.1rem; }
    .service-pricing-node { border-top: 1px solid var(--color-border); padding-top: 2rem; margin-bottom: 2rem; }
    .price-strike-val { font-size: 1.05rem; color: #94a3b8; text-decoration: line-through; display: block; margin-bottom: 0.3rem; font-weight: 600; }
    .price-final-val { font-size: 1.6rem; font-weight: 900; color: var(--color-dark-grey); display: block; }
    .price-highlight { color: #28a745; }
    .btn-cc-outline { display: block; text-align: center; padding: 16px; border: 2px solid var(--color-orange); color: var(--color-orange); text-decoration: none; font-weight: 700; border-radius: 12px; transition: all 0.2s ease; font-size: 1rem; }
    .btn-cc-outline:hover { background-color: var(--color-orange); color: var(--color-white); box-shadow: 0 8px 20px rgba(255, 107, 0, 0.2); }

    /* ==========================================================================
       3. CTA Section
       ========================================================================== */
    .cta-section { background: linear-gradient(135deg, #ff6b00 0%, #fa5a00 100%); color: var(--color-white); padding: 8rem 0; text-align: center; }
    .cta-section h2 { font-size: 3.5rem; margin-bottom: 2rem; color: var(--color-white); font-weight: 900; letter-spacing: -2px; }
    .cta-section p { font-size: 1.35rem; line-height: 1.8; max-width: 800px; margin: 0 auto 3.5rem auto; font-weight: 500; }
    .btn-cta-max { display: inline-block; background: var(--color-dark-grey); color: var(--color-white); padding: 22px 55px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 1.15rem; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2); }
    .btn-cta-max:hover { background: #1a1e26; transform: translateY(-4px); box-shadow: 0 20px 45px rgba(0, 0, 0, 0.3); }

    /* Responsivitas */
    @media (max-width: 768px) {
        .wide-container { padding: 0 24px; }
        .portofolio-page-section { padding: 9rem 0 6rem 0; }
        .layanan-page-section { padding: 6rem 0; }
        .section-header h1 { font-size: 2.8rem; }
        .section-header h2, .cta-section h2 { font-size: 2.4rem; }
        .service-body-node { padding: 2.5rem 2rem; }
    }
</style>
@endpush

@section('content')

    <section class="portofolio-page-section">
        <div class="wide-container">
            <div class="section-header">
                <h1>Portofolio Kami</h1>
                <p>Jelajahi berbagai karya produk digital riil yang telah kami bangun dengan standar performa tinggi, keamanan server, dan antarmuka yang elegan.</p>
            </div>
            
            <div class="porto-grid-container">
                @if(isset($portfolios) && count($portfolios) > 0)
                    @foreach($portfolios as $portfolio)
                        <div class="porto-grid-item">
                            <{{ $portfolio->link ? 'a' : 'div' }} {!! $portfolio->link ? 'href="'.$portfolio->link.'" target="_blank"' : '' !!} class="card-portfolio-modern">
                                <div class="portfolio-screen-dump">
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                                </div>
                                <div class="portfolio-meta-body">
                                    <h4>{{ $portfolio->title }}</h4>
                                    <p>{{ $portfolio->category }}</p>
                                </div>
                            </{{ $portfolio->link ? 'a' : 'div' }}>
                        </div>
                    @endforeach
                @else
                    <div style="width: 100%; text-align: center; padding: 50px 0; color:#888;">
                        <p>Belum ada data portofolio yang dipublikasikan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="layanan-page-section">
        <div class="wide-container">
            <div class="section-header">
                <h2>Solusi Layanan Utama</h2>
                <p>Kami merancang berbagai paket layanan komprehensif mulai dari pengembangan sistem infrastruktur teknis hingga taktik pemasaran di media sosial.</p>
            </div>
            
            <div class="layanan-grid-container">
                @if(isset($services) && count($services) > 0)
                    @foreach($services as $service)
                        <div class="layanan-grid-item">
                            <div class="card-service-premium">
                                <div class="service-thumbnail-node">
                                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}">
                                </div>
                                <div class="service-body-node">
                                    <h3>{{ $service->title }}</h3>
                                    <ul>
                                        @php
                                            $features = array_filter(explode("\n", str_replace("\r", "", $service->features)));
                                        @endphp
                                        @foreach($features as $feature)
                                            <li>{{ trim($feature) }}</li>
                                        @endforeach
                                    </ul>
                                    <div class="service-pricing-node">
                                        @if($service->price_strike)
                                            <span class="price-strike-val">{{ $service->price_strike }}</span>
                                            <span class="price-final-val price-highlight">{{ $service->price }}</span>
                                        @else
                                            <span class="price-final-val">{{ $service->price }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ $service->button_url ?: 'https://wa.me/62816282136' }}" class="btn-cc-outline" target="_blank">Lihat Detail Paket</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="width: 100%; text-align: center; padding: 50px 0; color:#888;">
                        <p>Belum ada data Layanan Utama yang dipublikasikan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="wide-container">
            <h2>Butuh Solusi Custom?</h2>
            <p>Setiap bisnis memiliki keunikannya masing-masing. Diskusikan secara langsung rancangan sistem atau strategi kampanye yang spesifik dengan tim spesialis kami hari ini.</p>
            <a href="https://wa.me/62816282136" class="btn-cta-max" target="_blank">Hubungi Kami via WhatsApp</a>
        </div>
    </section>

@endsection
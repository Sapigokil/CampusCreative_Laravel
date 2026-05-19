@extends('layouts.front')

@section('title', 'Jasa Pembuatan Website Semarang & Agensi Digital | Campus Creative')

@push('styles')
<style>
    /* ==========================================================================
       Variabel Warna & Pengaturan Layout Utama
       ========================================================================== */
    :root {
        --color-dark-grey: #0f1115;
        --color-dark-card: #181b22;
        --color-orange: #ff6b00;
        --color-orange-hover: #e05e00;
        --color-orange-light: #fff8f4;
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
    .text-orange { color: var(--color-orange); }

    .cc-row { display: flex; flex-wrap: wrap; margin-left: -20px; margin-right: -20px; }
    .cc-col-4 { width: 33.333%; padding: 0 20px; margin-bottom: 30px; }
    .cc-col-6 { width: 50%; padding: 0 20px; margin-bottom: 30px; }
    .flex-align-center { align-items: center; }
    .display-flex-match { display: flex; flex-direction: column; height: 100%; }

    /* ==========================================================================
       1. Hero Section 
       ========================================================================== */
    .hero-section { background: radial-gradient(circle at 90% 10%, #1e222b 0%, var(--color-dark-grey) 100%); color: var(--color-white); padding: 11rem 0 10rem 0; position: relative; }
    .hero-slide-container { position: relative; width: 100%; min-height: 520px; }
    .hero-slide-item { position: absolute; top: 0; left: 0; width: 100%; opacity: 0; visibility: hidden; transition: opacity 0.8s ease, visibility 0.8s; z-index: 1; }
    .hero-slide-item.active { opacity: 1; visibility: visible; position: relative; z-index: 2; }
    .hero-content h1 { font-size: 4.2rem; margin-bottom: 2rem; line-height: 1.15; color: var(--color-white); font-weight: 900; letter-spacing: -2px; }
    .hero-content p { font-size: 1.3rem; margin-bottom: 3.5rem; color: #94a3b8; line-height: 1.8; max-width: 620px; }
    .hero-buttons { display: flex; gap: 20px; }
    .btn-cc { display: inline-block; padding: 18px 38px; font-weight: 700; border-radius: 12px; text-decoration: none; transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.2s ease, box-shadow 0.3s ease; font-size: 1.05rem; text-align: center; }
    .btn-cc-primary { background-color: var(--color-orange); color: var(--color-white); box-shadow: 0 10px 30px rgba(255, 107, 0, 0.3); }
    .btn-cc-primary:hover { background-color: var(--color-orange-hover); transform: translateY(-3px); box-shadow: 0 15px 35px rgba(255, 107, 0, 0.4); }
    .btn-cc-secondary { border: 2px solid rgba(255, 255, 255, 0.15); color: var(--color-white); }
    .btn-cc-secondary:hover { border-color: var(--color-white); background-color: rgba(255, 255, 255, 0.04); transform: translateY(-2px); }
    .hero-visual-panel { position: relative; }
    .hero-window-mockup { background: #13161c; border-radius: 28px; height: 520px; border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6); overflow: hidden; display: flex; flex-direction: column; }
    .window-bar { background-color: rgba(0,0,0,0.4); padding: 16px 24px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; gap: 8px; z-index: 10; }
    .window-dot { width: 12px; height: 12px; background-color: #ff5f56; border-radius: 50%; }
    .window-dot:nth-child(2) { background-color: #ffbd2e; }
    .window-dot:nth-child(3) { background-color: #27c93f; }
    .window-canvas { flex-grow: 1; position: relative; background-color: #0f1115; }
    .window-dynamic-img { width: 100%; height: 100%; object-fit: cover; object-position: top center; }
    .hero-slider-dots { display: flex; justify-content: center; gap: 10px; margin-top: 40px; }
    .hero-dot { width: 12px; height: 12px; border-radius: 50%; background-color: rgba(255,255,255,0.2); cursor: pointer; transition: all 0.3s ease; }
    .hero-dot.active { background-color: var(--color-orange); transform: scale(1.2); }

    /* ==========================================================================
       2. Clients Brand Section 
       ========================================================================== */
    .clients-section { background-color: var(--color-white); padding: 6rem 0; border-bottom: 1px solid var(--color-border); overflow: hidden; width: 100%; }
    .clients-section h3 { font-size: 1rem; text-transform: uppercase; letter-spacing: 3px; color: var(--color-grey-light); margin-bottom: 4rem; font-weight: 700; text-align: center; }
    .marquee-container { display: block; width: 100%; overflow: hidden; white-space: nowrap; position: relative; }
    .marquee-container::before, .marquee-container::after { content: ""; position: absolute; top: 0; width: 100px; height: 100%; z-index: 2; pointer-events: none; }
    .marquee-container::before { left: 0; background: linear-gradient(to right, var(--color-white) 0%, transparent 100%); }
    .marquee-container::after { right: 0; background: linear-gradient(to left, var(--color-white) 0%, transparent 100%); }
    .marquee-track { display: inline-flex; align-items: center; width: max-content; animation: scrollLeft 35s linear infinite; }
    .marquee-container:hover .marquee-track { animation-play-state: paused; }
    .brand-item { flex: 0 0 auto; width: 200px; height: 90px; background: var(--color-white-off); border-radius: 16px; border: 1px solid #f1f5f9; display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s ease; padding: 15px; margin: 0 15px; }
    .brand-item:hover { border-color: rgba(255, 107, 0, 0.25); background-color: var(--color-white); box-shadow: 0 15px 30px rgba(0,0,0,0.04); transform: translateY(-3px); }
    .brand-item img { width: 100%; height: 100%; object-fit: contain; transition: all 0.3s ease; display: block; }
    .brand-item:hover img { transform: scale(1.05); }
    .brand-item-fallback { font-weight: 800; color: #cbd5e1; font-size: 1.1rem; letter-spacing: 1.5px; }
    @keyframes scrollLeft { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    /* ==========================================================================
       3. Why Us Section 
       ========================================================================== */
    .section-header { margin-bottom: 6rem; }
    .section-header h2 { font-size: 3.2rem; font-weight: 900; color: var(--color-dark-grey); margin-bottom: 1.5rem; letter-spacing: -1.5px; line-height: 1.15; }
    .section-header p { color: var(--color-grey-text); font-size: 1.25rem; max-width: 700px; margin: 0 auto; line-height: 1.7; }
    .why-us-section { background-color: var(--color-white-off); padding: 9rem 0; }
    .card-modern-why { padding: 4rem 3.5rem; background: var(--color-white); border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -1px rgba(0,0,0,0.01); border: 1px solid rgba(148, 163, 184, 0.12); transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); position: relative; }
    .card-modern-why:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.06); border-color: rgba(255, 107, 0, 0.3); }
    .card-modern-why::before { content: ""; position: absolute; top: 0; left: 40px; width: 50px; height: 4px; background-color: var(--color-orange); border-radius: 0 0 4px 4px; }
    .card-modern-why h3 { color: var(--color-dark-grey); margin-bottom: 1.5rem; font-size: 1.6rem; font-weight: 800; letter-spacing: -0.5px; }
    .card-modern-why p { color: var(--color-grey-text); line-height: 1.8; font-size: 1.05rem; }

    /* ==========================================================================
       4. Tentang Section (Kenali Campus Creative)
       ========================================================================== */
    .tentang-section { background: linear-gradient(135deg, #ff6b00 0%, #fa5a00 100%); padding: 10rem 0; color: var(--color-white); }
    .tentang-section h2 { font-size: 3.5rem; font-weight: 900; margin-bottom: 2.5rem; letter-spacing: -1.5px; text-align: center; }
    .tentang-section p { max-width: 1050px; margin: 0 auto; font-size: 1.4rem; color: var(--color-white); line-height: 1.85; font-weight: 500; text-align: justify; }

    /* ==========================================================================
       5. Layanan Section 
       ========================================================================== */
    .layanan-section { background-color: var(--color-white); padding: 9rem 0; }
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
       6. Portofolio Section
       ========================================================================== */
    .portofolio-section { background-color: var(--color-dark-grey); padding: 9rem 0; color: var(--color-white); }
    .portofolio-section .section-header h2 { color: var(--color-white); }
    .portofolio-section .section-header p { color: #cbd5e1; }
    .porto-grid-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin: 0 auto; width: 100%; }
    .porto-grid-item { display: flex; flex-direction: column; flex-grow: 1; flex-basis: 100%; max-width: 100%; }
    @media (min-width: 768px) { .porto-grid-item { flex-basis: calc(50% - 15px); max-width: calc(50% - 15px); } }
    @media (min-width: 1200px) { .porto-grid-item { flex-basis: calc(33.333% - 20px); max-width: calc(33.333% - 20px); } }

    .card-portfolio-modern { background-color: var(--color-dark-card); border-radius: 24px; overflow: hidden; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); border: 1px solid rgba(255,255,255,0.04); display: flex; flex-direction: column; height: 100%; width: 100%; text-decoration: none; }
    .card-portfolio-modern:hover { transform: translateY(-8px); border-color: rgba(255, 107, 0, 0.5); box-shadow: 0 30px 60px rgba(0,0,0,0.5); }
    .portfolio-screen-dump { height: 280px; background-color: #1f232d; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .portfolio-screen-dump img { width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.6s ease; }
    .card-portfolio-modern:hover .portfolio-screen-dump img { transform: scale(1.05); }
    .portfolio-screen-inner { font-size: 1rem; color: rgba(255,255,255,0.25); font-weight: 700; letter-spacing: 2px; border: 1px dashed rgba(255,255,255,0.1); padding: 14px 28px; border-radius: 8px; }
    .portfolio-meta-body { padding: 2.5rem; flex-grow: 1; }
    .portfolio-meta-body h4 { margin-bottom: 0.8rem; color: var(--color-white); font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; line-height: 1.4; }
    .portfolio-meta-body p { color: var(--color-orange); font-size: 0.95rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin: 0; }
    .porto-action-wrapper { text-align: center; margin-top: 5rem; }

    /* ==========================================================================
       7. Testimoni Section 
       ========================================================================== */
    .testimoni-section { background-color: var(--color-white-off); padding: 9rem 0; }
    .testimoni-grid-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; margin: 0 auto; justify-content: center; }
    .testimoni-box-card { background: var(--color-white); padding: 3rem 2.5rem; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 20px 40px -5px rgba(0,0,0,0.02); border: 1px solid var(--color-border); display: flex; flex-direction: column; transition: all 0.3s ease; height: 100%; }
    .testimoni-box-card:hover { transform: translateY(-6px); box-shadow: 0 25px 50px rgba(0,0,0,0.06); border-color: rgba(255, 107, 0, 0.3); }
    .quote-mark { font-size: 4rem; line-height: 1; color: var(--color-orange); display: block; margin-bottom: 1rem; font-family: serif; font-weight: bold; }
    .testimoni-quote { font-size: 1.15rem; color: var(--color-dark-grey); line-height: 1.7; font-weight: 500; margin-bottom: 2.5rem; flex-grow: 1; font-style: italic; }
    .testimoni-author-wrapper { display: flex; align-items: center; gap: 16px; border-top: 1px solid #f1f5f9; padding-top: 1.5rem; }
    .testimoni-avatar { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid var(--color-white); box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
    .testimoni-avatar-placeholder { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, var(--color-orange) 0%, #ff9b54 100%); display: flex; align-items: center; justify-content: center; color: var(--color-white); font-weight: 900; font-size: 1.4rem; box-shadow: 0 4px 10px rgba(255, 107, 0, 0.2); }
    .author-info-node { display: flex; flex-direction: column; }
    .author-info-node .name { font-weight: 800; font-size: 1.15rem; color: var(--color-dark-grey); margin-bottom: 0.2rem; }
    .author-info-node .role { font-size: 0.9rem; color: var(--color-grey-light); font-weight: 600; }

    /* ==========================================================================
       8. Blog / Artikel Section
       ========================================================================== */
    .blog-section { background-color: var(--color-white); padding: 9rem 0; }
    .card-blog-editorial { background: var(--color-white); border-radius: 24px; overflow: hidden; border: 1px solid var(--color-border); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01); transition: all 0.3s ease; }
    .card-blog-editorial:hover { transform: translateY(-6px); box-shadow: 0 25px 45px rgba(15,23,42,0.06); border-color: rgba(148,163,184,0.3); }
    .editorial-img-node { height: 240px; background-color: #f8fafc; display: flex; align-items: center; justify-content: center; color: var(--color-grey-light); font-weight: 700; font-size: 0.95rem; letter-spacing: 1px; border-bottom: 1px solid #f1f5f9; overflow: hidden; }
    .editorial-img-node img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .card-blog-editorial:hover .editorial-img-node img { transform: scale(1.05); }
    .editorial-body-node { padding: 2.5rem; }
    .editorial-time-meta { font-size: 0.9rem; color: var(--color-grey-light); margin-bottom: 1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
    .editorial-body-node h4 { font-size: 1.4rem; line-height: 1.45; font-weight: 800; letter-spacing: -0.5px; }
    .editorial-body-node h4 a { color: var(--color-dark-grey); text-decoration: none; transition: color 0.2s; }
    .editorial-body-node h4 a:hover { color: var(--color-orange); }

    /* ==========================================================================
       9. CTA Section
       ========================================================================== */
    .cta-section { background: linear-gradient(180deg, var(--color-dark-grey) 0%, #050608 100%); color: var(--color-white); padding: 10rem 0; text-align: center; }
    .cta-section h2 { font-size: 3.8rem; margin-bottom: 2rem; color: var(--color-white); font-weight: 900; letter-spacing: -2px; }
    .cta-section p { color: #94a3b8; font-size: 1.35rem; line-height: 1.8; max-width: 800px; margin: 0 auto 4.5rem auto; }
    .btn-cta-max { display: inline-block; background: var(--color-orange); color: var(--color-white); padding: 22px 55px; border-radius: 14px; text-decoration: none; font-weight: 800; font-size: 1.15rem; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 0 15px 35px rgba(255, 107, 0, 0.3); }
    .btn-cta-max:hover { background: var(--color-orange-hover); transform: translateY(-4px); box-shadow: 0 20px 45px rgba(255, 107, 0, 0.45); }

    /* Responsivitas */
    @media (max-width: 1200px) { .hero-content h1 { font-size: 3.5rem; } }
    @media (max-width: 992px) {
        .wide-container { padding: 0 24px; }
        .cc-col-6 { width: 100%; margin-bottom: 30px; }
        .hero-slide-container { min-height: auto; }
        .hero-slide-item { position: relative; opacity: 1; visibility: visible; display: none; }
        .hero-slide-item.active { display: block; }
        .hero-content { text-align: center; padding-right: 0; margin-bottom: 4rem; }
        .hero-content p { margin-left: auto; margin-right: auto; }
        .hero-buttons { justify-content: center; }
        .hero-window-mockup { height: 400px; }
    }
    @media (max-width: 768px) {
        .hero-section, .clients-section, .why-us-section, .tentang-section, .layanan-section, .portofolio-section, .testimoni-section, .blog-section, .cta-section { padding: 6rem 0; }
        .cc-col-4, .cc-col-6 { width: 100%; padding: 0; margin-bottom: 30px; }
        .cc-row { margin-left: 0; margin-right: 0; }
        .hero-content h1 { font-size: 2.8rem; letter-spacing: -1px; }
        .section-header h2, .tentang-section h2, .cta-section h2 { font-size: 2.4rem; letter-spacing: -1px; }
        .card-modern-why, .service-body-node, .editorial-body-node, .testimoni-box-card { padding: 2.5rem 2rem; }
        .testimoni-quote { font-size: 1.05rem; }
        .hero-window-mockup { height: 300px; }
    }
</style>
@endpush

@section('content')
    <section class="hero-section">
        <div class="wide-container">
            @if(isset($heroes) && count($heroes) > 0)
                <div class="hero-slide-container" id="hero-slider-main">
                    @foreach($heroes as $index => $hero)
                        <div class="hero-slide-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="cc-row flex-align-center">
                                <div class="cc-col-6">
                                    <div class="hero-content">
                                        <h1>{{ $hero->title ?: 'Jasa Pembuatan Website & Agensi Digital Kreatif' }}</h1>
                                        <p>{{ $hero->subtitle ?: 'Campus Creative hadir untuk mendigitalisasi bisnis Anda. Kami merancang website berkinerja tinggi, mengelola operasional digital, hingga mengoptimasi jangkauan.' }}</p>
                                        <div class="hero-buttons">
                                            @if($hero->button_text)
                                                <a href="{{ $hero->button_url ?: '#' }}" class="btn-cc btn-cc-primary">{{ $hero->button_text }}</a>
                                            @endif
                                            <a href="{{ route('front.services') }}" class="btn-cc btn-cc-secondary">Lihat Layanan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cc-col-6">
                                    <div class="hero-visual-panel">
                                        <div class="hero-window-mockup">
                                            <div class="window-bar"><div class="window-dot"></div><div class="window-dot"></div><div class="window-dot"></div></div>
                                            <div class="window-canvas">
                                                <img src="{{ asset('storage/' . $hero->image) }}" alt="{{ $hero->title }}" class="window-dynamic-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(count($heroes) > 1)
                    <div class="hero-slider-dots">
                        @foreach($heroes as $index => $hero)
                            <div class="hero-dot {{ $index == 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="cc-row flex-align-center">
                    <div class="cc-col-6">
                        <div class="hero-content">
                            <h1>Jasa Pembuatan Website <span class="text-orange">Semarang</span> & Agensi Digital Kreatif</h1>
                            <p>Campus Creative hadir untuk mendigitalisasi bisnis Anda. Kami merancang website berkinerja tinggi, mengelola operasional digital, hingga mengoptimasi jangkauan media sosial Anda.</p>
                            <div class="hero-buttons">
                                <a href="{{ route('front.services') }}" class="btn-cc btn-cc-secondary">Lihat Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="cc-col-6">
                        <div class="hero-visual-panel">
                            <div class="hero-window-mockup">
                                <div class="window-bar"><div class="window-dot"></div><div class="window-dot"></div><div class="window-dot"></div></div>
                                <div class="window-canvas" style="display:flex; align-items:center; justify-content:center; flex-direction:column; color: rgba(255,255,255,0.4);">
                                    <div style="font-size: 5rem; animation: floatAnimation 4s ease-in-out infinite;">⚡</div>
                                    <div style="font-weight: 700; margin-top: 24px; letter-spacing: 1px; font-size: 0.9rem;">BELUM ADA GAMBAR DIUPLOAD</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="clients" class="clients-section">
        <div class="wide-container">
            <h3>Dipercaya Oleh Berbagai Bisnis</h3>
            <div class="marquee-container">
                <div class="marquee-track">
                    @if(isset($clients) && count($clients) > 0)
                        @foreach($clients as $client)
                            <div class="brand-item"><img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}"></div>
                        @endforeach
                        @foreach($clients as $client)
                            <div class="brand-item"><img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}"></div>
                        @endforeach
                        @foreach($clients as $client)
                            <div class="brand-item"><img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}"></div>
                        @endforeach
                    @else
                        <div class="brand-item"><span class="brand-item-fallback">KLIEN 1</span></div>
                        <div class="brand-item"><span class="brand-item-fallback">KLIEN 2</span></div>
                        <div class="brand-item"><span class="brand-item-fallback">KLIEN 3</span></div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="why-us" class="why-us-section">
        <div class="wide-container">
            <div class="section-header text-center">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Alasan utama mengapa Campus Creative dipercaya oleh puluhan perusahaan untuk memegang kendali transformasi digital mereka.</p>
            </div>
            <div class="cc-row">
                <div class="cc-col-4">
                    <div class="card-modern-why display-flex-match">
                        <h3>Tim Berpengalaman</h3>
                        <p>Ditangani langsung oleh senior developer dan digital growth marketer yang telah berpengalaman menyelesaikan masalah arsitektur kode dan konversi pasar.</p>
                    </div>
                </div>
                <div class="cc-col-4">
                    <div class="card-modern-why display-flex-match">
                        <h3>Transparan & Terukur</h3>
                        <p>Akses pemantauan pengerjaan proyek real-time serta laporan analitik performa yang disajikan secara gamblang tanpa ada yang disembunyikan.</p>
                    </div>
                </div>
                <div class="cc-col-4">
                    <div class="card-modern-why display-flex-match">
                        <h3>Dukungan Purna Jual</h3>
                        <p>SLA jaminan penanganan kendala bug sistem, keamanan server, serta bantuan konsultasi berkala setelah fase serah terima aplikasi selesai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="tentang-section">
        <div class="wide-container">
            <h2>Kenali Campus Creative</h2>
            <p>Sebagai mitra agensi digital dan jasa pembuatan website Semarang yang berpengalaman, kami hadir untuk mengakselerasi bisnis Anda melalui tiga pilar ekosistem solusi digital ujung-ke-ujung: Jasa Pembuatan Website berskala enterprise, arsitektur sistem informasi khusus, dan e-commerce; Jasa Pengelolaan Sosial Media strategis berbasis data analitik; serta Pembuatan Konten Digital sinematik berkualitas tinggi. Kami sepenuhnya mengambil alih kendali kompleksitas teknologi, infrastruktur server, dan manajemen konten, agar Anda bisa tetap fokus membesarkan skala bisnis utama Anda.</p>
        </div>
    </section>

    <section id="layanan" class="layanan-section">
        <div class="wide-container">
            <div class="section-header text-center">
                <h2>Layanan Utama Kami</h2>
                <p>Ekosistem solusi digital ujung-ke-ujung yang dirancang khusus untuk mendorong akselerasi performa bisnis Anda.</p>
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

    <section id="portofolio" class="portofolio-section">
        <div class="wide-container">
            <div class="section-header text-center">
                <h2>Karya Terbaik Kami</h2>
                <p>Portofolio produk digital terintegrasi yang dibangun dengan performa tinggi, stabilitas server, dan kenyamanan antarmuka.</p>
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
                    <div class="porto-grid-item">
                        <div class="card-portfolio-modern">
                            <div class="portfolio-screen-dump"><div class="portfolio-screen-inner">E-COMMERCE SHOWCASE</div></div>
                            <div class="portfolio-meta-body">
                                <h4>Website E-Commerce Fashion</h4>
                                <p>Website Development</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="porto-action-wrapper">
                <a href="{{ route('front.services') }}" class="btn-cc btn-cc-primary">Lihat Seluruh Karya</a>
            </div>
        </div>
    </section>

    <section id="testimoni" class="testimoni-section">
        <div class="wide-container">
            <div class="section-header text-center">
                <h2>Apa Kata Klien Kami?</h2>
                <p>Validasi nyata kepuasan mitra korporasi atas kapabilitas pengerjaan teknis dari tim Campus Creative.</p>
            </div>
            
            <div class="testimoni-grid-container">
                @if(isset($testimonials) && count($testimonials) > 0)
                    @foreach($testimonials as $testi)
                        <div class="testimoni-box-card">
                            <span class="quote-mark">“</span>
                            <blockquote class="testimoni-quote">"{{ $testi->review }}"</blockquote>
                            <div class="testimoni-author-wrapper">
                                @if($testi->photo)
                                    <img src="{{ asset('storage/' . $testi->photo) }}" alt="{{ $testi->name }}" class="testimoni-avatar">
                                @else
                                    <div class="testimoni-avatar-placeholder">{{ strtoupper(substr($testi->name, 0, 1)) }}</div>
                                @endif
                                <div class="author-info-node">
                                    <div class="name">{{ $testi->name }}</div>
                                    <div class="role">{{ $testi->instansi }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="testimoni-box-card">
                        <span class="quote-mark">“</span>
                        <blockquote class="testimoni-quote">"Transformasi sistem bersama Campus Creative melampaui ekspektasi kami. Arsitektur backend sangat kokoh, load website jauh lebih gegas dibanding platform lama."</blockquote>
                        <div class="testimoni-author-wrapper">
                            <div class="testimoni-avatar-placeholder">B</div>
                            <div class="author-info-node">
                                <div class="name">Budi Santoso</div>
                                <div class="role">CEO PT. Solusi Maju Bersama</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="blog" class="blog-section">
        <div class="wide-container">
            <div class="section-header text-center">
                <h2>Artikel &amp; Wawasan Terbaru</h2>
                <p>Kumpulan studi kasus, analisis teknologi, dan panduan praktis pengelolaan ekosistem digital bisnis.</p>
            </div>
            
            <div class="blog-grid cc-row">
                @if(isset($latestPosts) && count($latestPosts) > 0)
                    @foreach($latestPosts as $post)
                        <div class="cc-col-4">
                            <div class="card-blog-editorial display-flex-match">
                                <div class="editorial-img-node">
                                    @if($post->featured_image)
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                    @else
                                        NO IMAGE
                                    @endif
                                </div>
                                <div class="editorial-body-node">
                                    <div class="editorial-time-meta">
                                        {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }} 
                                        @if($post->category)
                                            • {{ $post->category->name }}
                                        @endif
                                    </div>
                                    <h4><a href="{{ url('/artikel/' . $post->slug) }}">{{ $post->title }}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="width: 100%; text-align: center; padding: 50px 0; color:#888;">
                        <p>Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="cta" class="cta-section">
        <div class="wide-container">
            <h2>Siap Mendigitalisasi Bisnis Anda?</h2>
            <p>Sinergikan kebutuhan digitalisasi proses bisnis, pembuatan platform manajemen data, serta peningkatan jangkauan brand market Anda bersama barisan tim ahli kami sekarang.</p>
            <a href="https://wa.me/62816282136" class="btn-cta-max" target="_blank">Inisiasi Konsultasi Gratis</a>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.hero-slide-item');
            const dots = document.querySelectorAll('.hero-dot');
            
            if(slides.length <= 1) return; 
            
            let currentSlide = 0;
            const slideCount = slides.length;
            let slideInterval;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));

                slides[index].classList.add('active');
                if(dots[index]) dots[index].classList.add('active');
                
                currentSlide = index;
            }

            function nextSlide() {
                let next = (currentSlide + 1) % slideCount;
                showSlide(next);
            }

            window.goToSlide = function(index) {
                showSlide(index);
                resetInterval();
            };

            function resetInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000); 
            }

            resetInterval();
        });
    </script>
@endsection